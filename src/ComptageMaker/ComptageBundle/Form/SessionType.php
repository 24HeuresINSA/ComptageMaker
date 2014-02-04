<?php

namespace ComptageMaker\ComptageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SessionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entries','number', array(
                'label' => 'Nombre de places',
                'required' => true,
            ))
            ->add('type','choice', array(
                'choices' => array('velo' => 'velo', 'moto' => 'moto', 'voiture' => 'voiture'),
                'required' => true,
                'label' => 'Type de Session',
            ))
            ->add('prix','money', array(
                'currency' => 'EUR',
                'precision' => 0,
                'required' => true,
                'label' => 'Prix en euros par heure'
            ))
            ->add('plage','entity', array(
                'class' => 'ComptageMakerComptageBundle:Plage',
                'property' => 'nom',
                'required' => true,
                'multiple' => false,
                'label' => 'Sélection des plages'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ComptageMaker\ComptageBundle\Entity\Session'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'comptagemaker_comptagebundle_session';
    }
}
