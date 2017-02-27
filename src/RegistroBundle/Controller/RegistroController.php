<?php

namespace RegistroBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RegistroBundle\Entity\Registro;
use RegistroBundle\Form\RegistroType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Registro controller.
 *
 * @Route("/registro")
 */
class RegistroController extends Controller
{
    /**
     * Lists all Registro entities.
     *
     * @Route("/", name="registro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $registros = $em->getRepository('RegistroBundle:Registro')->findAll();

        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,

        ));
    }

    /**
     * Inicio de registro.
     *
     * @Route("/start", name="registro_inicio")
     * @Method({"GET", "POST"})
     */
    public function startAction(Request $request)
    {

        $defaultData = array('message' => 'Type your message here');
        $formail = $this->createFormBuilder($defaultData)
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\EmailType',array('label'=>'Ingresa tu correo'))
            ->getForm();

        $formail->handleRequest($request);

        if ($formail->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $mail = $formail->getData('mail');
            $em = $this->getDoctrine()->getManager();
            $registro = $em->getRepository('RegistroBundle:Registro')->findOneByMail($mail);

            if (!$registro) {
                throw $this->createNotFoundException(
                    'Registro no encontrado'
                );
            }

            $id = $registro->getId();
            $editForm = $this->createForm('RegistroBundle\Form\RegistroType', $registro);

            //return $this->render('registro/edit.html.twig', array('id' => $id, 'mail'=>$mail,'edit_form' => $editForm->createView(),'registro'=> $registro));

            return $this->render('registro/start.html.twig', array(
                'registro' => $registro,
            ));
        }

        return $this->render('registro/start.html.twig', array(
            'form' => $formail->createView(),

        ));
    }

    /**
     * Creates a new Registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $registro = new Registro();
        $form = $this->createForm('RegistroBundle\Form\RegistroType', $registro);

        $form->remove('actividadm');
        $form->remove('actividadv');
        $form->remove('comida');
        $form->remove('playera');
        $form->remove('sexo');

        $form->add('actividadm',null,array('label'=>false));
        $form->add('actividadv',null,array('label'=>false));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            // Obtiene correo y msg de la forma de contacto
            $mailer = $this->get('mailer');

            $message = \Swift_Message::newInstance()
                ->setSubject('Registro Feria Matemática 2017')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getMail()))
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mail.txt.twig', array('entity' => $registro)))
            ;
            $mailer->send($message);

            //return $this->redirectToRoute('registro_show', array('id' => $registro->getId()));

            return $this->render('registro/confirm.html.twig', array('id' => $registro->getId(),'entity'=>$registro));
            //return $this->render('registro/start.html.twig', array('id' => $registro->getId(),'entity'=>$registro));

        }

        return $this->render('registro/new.html.twig', array(
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Registro entity.
     *
     * @Route("/{id}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);

        return $this->render('registro/show.html.twig', array(
            'registro' => $registro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Registro entity.
     *
     * @Route("/{id}/edit/{mail}", name="registro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registro $registro, $mail)
    {
        $em = $this->getDoctrine()->getManager();
        $registro = $em->getRepository('RegistroBundle:Registro')->findOneByMail($mail);

        //$deleteForm = $this->createDeleteForm($registro);
        $editForm = $this->createForm('RegistroBundle\Form\RegEditType', $registro);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {

                return $this->redirectToRoute('registro_index');

            }
            // Obtiene correo y msg de la forma de contacto
            $mailer = $this->get('mailer');

            $message = \Swift_Message::newInstance()
                ->setSubject('Actividades Feria Matemática 2017')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($registro->getMail()))
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('registro/mail-actividades.txt.twig', array('entity' => $registro)))
            ;
             $mailer->send($message);

            $this->addFlash(
                'notice',
                'Tu registro ha sido modificado'
            );

            return $this->redirectToRoute('registro_edit', array('mail'=> $mail,'id' => $registro->getId()));
        }

        return $this->render('registro/edit.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            // 'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registro $registro)
    {
        $form = $this->createDeleteForm($registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registro);
            $em->flush();
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * Creates a form to delete a Registro entity.
     *
     * @param Registro $registro The Registro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registro $registro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $registro->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}