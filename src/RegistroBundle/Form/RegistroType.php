<?php

namespace RegistroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;



class RegistroType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paterno','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Apellido paterno'))
            ->add('materno','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Apellido materno'))
            ->add('nombre','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Nombre'))
            ->add('mail','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Correo electrónico'))
            ->add('instituciones','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array('choices'  => array(
                'Escuela Nacional de Estudios Superiores (ENES), UNAM Campus Morelia'=>'ENES',
                'Facultad de Ciencias Físico-Matemáticas (FISMAT), UMSNH' => 'FISMAT',
                'Instituto Tecnológico de Morelia (ITM)'=>'ITM',
                'Posgrado Conjunto (PCCM), UNAM-UMSNH'=>'PCCM',
                'Otro'=> 'Otro',

            ),
                // *this line is important*
                'choices_as_values' => true,
                'placeholder' => 'Seleccionar',
                'label'=>'Institución de procedencia',
                'mapped'=> false,

            ))
            ->add('institucion','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Nombre de la Institución', 'read_only'=> true))

        ;

        $formModifier = function (FormInterface $form, $otro) {

            if ( 'Otro' == $otro) {
                $form->add('institucion', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                    'label' => 'Nombre de la Institución',
                    ));
            }

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getInstitucion());

            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $val = $data['instituciones'];
                if ( $val !='Otro') {
                    $data['institucion'] = $val;
                    $event->setData($data);
                }
            }
        );

        $builder->get('instituciones')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!

                $formModifier($event->getForm()->getParent(),$sport);

            }
        );

        $builder->add('carrera')
            ->add('actividadm',  new ActividadType(), array(
                'data_class' => null,
            ))
            ->add('actividadv',  new ActividadType(), array(
                'data_class' => null,
            ))
        ;

    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RegistroBundle\Entity\Registro',


        ));
    }

}
