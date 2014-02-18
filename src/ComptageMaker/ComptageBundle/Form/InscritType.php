<?php

namespace ComptageMaker\ComptageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InscritType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text', array(
                'label' => 'Nom',
                'required' => true,
            ))
            ->add('prenom','text',array(
                'label' => 'Prénom',
                'required' => true,
            ))
            ->add('mail','email',array(
                'label' => 'Email',
                'required' => true,
            ))
            ->add('tel','text', array(
                'label' => 'Téléphone',
                'required' => true,
            ))
            ->add('association','entity',array(
                'class' => 'ComptageMakerComptageBundle:Association',
                'property' => 'name',
                'multiple' => false,
                'label' => 'Association',
                'required' => false,
                ))
            ->add('nassociation','text',array(
                'label' => 'Autre association',
                'required' => false,
                'mapped' => false,
            ))
           ->add('voiture','checkbox', array(
                'label' => 'Avez-vous une voiture?',
                'required' => false,
            ))
           ->add('commentaires','textarea', array(
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
            'data_class' => 'ComptageMaker\ComptageBundle\Entity\Inscrit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'comptagemaker_comptagebundle_inscrit';
    }
}
