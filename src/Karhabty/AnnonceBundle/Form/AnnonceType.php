<?php

namespace Karhabty\AnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('AnneeDeProduit')
            ->add('AnneePub')
            ->add('Model')
            ->add('Marque')
            ->add('Region')
            ->add('Ville')
            ->add('Paye')
            ->add('Prix')
            ->add('Category', ChoiceType::class, array(
                'choices'  => array(
                    'accessoire' => 'accessoire',
                    'voiture' => 'voiture',
                    'pieces' => 'pieces',
                )))



            ->add('imageFile',FileType::class,array(
                'data_class' => null,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Karhabty\AnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'karhabty_annoncebundle_annonce';
    }


}
