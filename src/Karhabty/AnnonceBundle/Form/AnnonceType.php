<?php

namespace Karhabty\AnnonceBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('AnneeDeProduit',DateType::class, ['widget' => 'single_text', 'format' => 'dd-MM-yyyy'])
            ->add('Model')
            ->add('Marque')
            ->add('Region')
            ->add('Ville')
            ->add('Paye')
            ->add('Descreption')
            ->add('Prix',IntegerType::class)
            ->add('Category', ChoiceType::class, array(
                'choices'  => array(
                    'accessoire' => 'accessoire',
                    'voiture' => 'voiture',
                    'pieces' => 'pieces',
                )))



            ->add('imageFile',VichFileType::class,array('label' => 'upload file',
                    'attr'=> array('class'=> 'fileContainer'),
                    'required' => false,
                    'allow_delete' => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true

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
