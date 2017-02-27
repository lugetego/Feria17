<?php

namespace RegistroBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ActividadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('burbujas', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Burbujas y Matemáticas',
                'required'=>false,
            ))
            ->add('calabozos', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Calabozos y problemas',
                'required'=>false,
            ))
            ->add('canguro', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Canguro Matemático',
                'required'=>false,
            ))
            ->add('club', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Club de Mate',
                'required'=>false,
            ))
            ->add('expo', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Expo Mates',
                'required'=>false,
            ))
            ->add('geografia', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Geografía y matemáticas (CIGA-UNAM)',
                'required'=>false,
            ))
            ->add('loteria', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Lotería de sombras',
                'required'=>false,
            ))
            ->add('matemagia', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Matemagia',
                'required'=>false,
            ))
            ->add('braille', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Matematicas y Braille',
                'required'=>false,
            ))
            ->add('mosaicos', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Mosaicos en desorden (Penrose)',
                'required'=>false,
            ))
            ->add('museo', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Museo Matemático',
                'required'=>false,
            ))
            ->add('nudos', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Nudos',
                'required'=>false,
            ))
            ->add('pesca', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Pesca planetaria; Planetario (IRyA-UNAM)',
                'required'=>false,
            ))
            ->add('rompecabezas', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Rompecabezas matemáticos; Policubos y poliminós (CIMAT-Gto)',
                'required'=>false,
            ))
            ->add('topologia', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Topologia del pantalón',
                'required'=>false,
            ))
            ->add('torres', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label'=>'Torres de Hanoi',
                'required'=>false,
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


    /**
     * @return string
     */
    public function getName()
    {
        return 'registrobundle_actividad';
    }


}
