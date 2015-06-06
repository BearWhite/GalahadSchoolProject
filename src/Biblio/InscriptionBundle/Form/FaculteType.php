<?php

namespace Biblio\InscriptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FaculteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text', array(
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Nom'
                            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Biblio\EntityBundle\Entity\Faculte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biblio_entitybundle_faculte';
    }
}
