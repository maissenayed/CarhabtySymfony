<?php
// src/AppBundle/Form/RegistrationType.php

namespace Karhabty\UserBundle\Form;
use Karhabty\UserBundle\Form\StringToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationParticulierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $transformer = new StringToArrayTransformer();
        $builder

            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ;

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}


