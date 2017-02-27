<?php

namespace RegistroBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RegistroBundle\Entity\Registro;
use RegistroBundle\Form\RegistroType;

/**
 * Register controller.
 *
 * @Route("/admin")

 * @Method("GET")
 * @Template()
 */

class AdminController extends Controller
{
    /**
     * Lists all Register entities.
     *
     * @Route("/", name="admin")
     * @Template("admin/login.html.twig")
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
     * Displays a list of mails
     *
     * @Route("/eval/mails", name="mails")
     * @Template()
     */
    public  function mailAction()
    {
        $em = $this->getDoctrine()->getManager();
        $registros = $em->getRepository('RegistroBundle:Registro')->findAll();
        //return $this->render('CcmEmmbioBundle:Regs:mails.html.twig', array('entities' => $entities));

    }
}
