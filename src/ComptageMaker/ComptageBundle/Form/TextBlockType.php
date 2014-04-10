<?php

namespace ComptageMaker\ComptageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextBlockType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',array(
                'required' => true,
                'label' => 'Titre',
            ))
            ->add('text','textarea', array(
                'required' => true,
                'label' => 'Texte à afficher (tags html supportés)',
                'attr' => array('cols' => '40','rows' => '5'),
            ))
            ->add('order','number', array(
                'required' => false,
                'label' => 'Ordre sur la page',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ComptageMaker\ComptageBundle\Entity\TextBlock'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'comptagemaker_comptagebundle_textblock';
    }
}
