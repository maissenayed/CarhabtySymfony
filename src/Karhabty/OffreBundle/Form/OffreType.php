<?php

namespace Karhabty\OffreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class OffreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomOffre')
            ->add('descriptionOffre',TextareaType::class)
            ->add('prix')
            ->add('tauxReduction')
            ->add('dateExpirationOffre',DateType::class, array(
                'widget' => 'single_text',
                'attr' => array(
                    'min' => date('Y-m-d')
                )
            ))
            ->add('imageFile', FileType::class, array('data_class' => null));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Karhabty\OffreBundle\Entity\Offre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'karhabty_offrebundle_offre';
    }


}
