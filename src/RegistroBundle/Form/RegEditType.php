<?php

namespace RegistroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;



class RegEditType extends AbstractType
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
            ->add('institucion','Symfony\Component\Form\Extension\Core\Type\TextType', array('label' => 'Nombre de la Institución', 'read_only'=> true))
            ->add('carrera')

            ->add('actividadm',  new ActividadType(), array(
                'data_class' => null,
            ))
            ->add('actividadv',  new ActividadType(), array(
                'data_class' => null,
            ))
            ->add('comida', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Si ',
                    false=>'No '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'¿Deseas comida vegetariana?',
                'choices_as_values' => false,
            ))
            ->add('sexo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'=>array(
                    true=>'Hombre ',
                    false=>'Mujer '),
                'expanded'=>true,
                'required'=>true,
                'label'=>'Playera',
                'choices_as_values' => false,
            ))

            ->add('playera','Symfony\Component\Form\Extension\Core\Type\ChoiceType', array('choices'  => array(
                'CH'=>'CH',
                'M' => 'M',
                'G' => 'G',
                'XG'=> 'XG',

            ),
                // *this line is important*
                'choices_as_values' => true,
                'placeholder' => 'Seleccionar',
                'label'=>'Talla de playera',

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
