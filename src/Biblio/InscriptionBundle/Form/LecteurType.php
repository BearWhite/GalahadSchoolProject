<?php

namespace Biblio\InscriptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LecteurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text', array(
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Pseudo'
                            ))
            ->add('password','text', array(
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Mot de passe'
                            ))        
            ->add('nom','text', array(
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Nom'
                            ))
            ->add('prenom','text', array(
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Prenom'
                            ))
            ->add('cycle','entity', array(
                            'class' => "BiblioEntityBundle:Cycle",
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Cycle'
                            ))
            ->add('faculte','entity', array(
                            'class' => "BiblioEntityBundle:Faculte",
                            'attr' => array('class' => 'form-control'),
                            'label' => 'Faculté'
                            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Biblio\EntityBundle\Entity\Lecteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'biblio_inscriptionbundle_lecteur';
    }
}
