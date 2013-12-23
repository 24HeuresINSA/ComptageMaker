<?php

namespace ComptageMaker\ComptageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text', array(
                'required' => true,
                'label' => 'Nom de la plage',
            ))
            ->add('debut','time', array(
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'label' => 'Début de la plage',
            ))
            ->add('fin','time',array(
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'label' => 'Fin de la plage',
            ))
            ->add('save','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ComptageMaker\ComptageBundle\Entity\Plage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'comptagemaker_comptagebundle_plage';
    }
}
