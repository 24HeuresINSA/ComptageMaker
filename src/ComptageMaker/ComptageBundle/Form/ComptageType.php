<?php

namespace ComptageMaker\ComptageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComptageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date','date',array(
                'input' => 'datetime',
                'widget' => 'choice',
                'label' => 'Date du comptage',
                'required' => true,
            ))
            ->add('briefing','datetime',array(
                'input' => 'datetime',
                'widget' => 'choice',
                'label' => 'Date et heure du briefing',
                'required' => true,
            ))
            ->add('etat','choice',array(
                'choices' => array(0 => 'Fermé', 1 => 'Ouvert'),
                'label' => 'Etat initial du comptage',
                'required' => true,
                'preferred_choices' => array(0 => 'Fermé'),
            ))
            ->add('comment','textarea',array(
                'label' => 'Commentaires',
                'required' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ComptageMaker\ComptageBundle\Entity\Comptage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'comptagemaker_comptagebundle_comptage';
    }
}
