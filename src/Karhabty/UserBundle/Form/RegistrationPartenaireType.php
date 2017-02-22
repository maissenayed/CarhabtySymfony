<?php
// src/AppBundle/Form/RegistrationType.php

namespace Karhabty\UserBundle\Form;
use Karhabty\UserBundle\Form\StringToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationPartenaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $transformer = new StringToArrayTransformer();

        $builder

            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('nomsociete')
            ->add('siret')
            ->add('activite',ChoiceType::class, array(
                'choices'  => array(
                    'Auto-école' => 'auto',
                    'Mécanicien' => 'mecanicien',
                    'Lavage' => 'lavage',
                    'vendeur Piéce d\étaché' => 'piece',
                    'vendeur d\'Accessoires' => 'accessoire',

                ),
            ));

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


