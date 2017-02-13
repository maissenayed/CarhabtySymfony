<?php

namespace Karhabty\AstuceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class AstuceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme', ChoiceType::class, array(
                'choices' => array('Entretien' => 'Entretien', 'VenteEtAchat' => 'Vente Et Achat', 'Consommation' => 'Consommation', 'Conduite' => 'Conduite', 'Autre' => 'Autre'),
                'required' => false,
            ))
            ->add('titre')
            ->add('description', TextareaType::class)
            ->add('date', DateTimeType::class)

            ->add('imageFile', FileType::class)
            ->add('Valider', SubmitType::class)
            ->add('Annuler', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Karhabty\AstuceBundle\Entity\Astuce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'karhabty_astucebundle_astuce';
    }


}
