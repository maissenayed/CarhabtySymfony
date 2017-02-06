<?php

namespace Karhabty\FutureConducteurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('questionContent')->add('imgUrl')        ;
        $builder->add('reponses', CollectionType::class, array(
            'entry_type' => ReponseType::class,
            'allow_add'    => true,
            'by_reference' => false,
        ));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Karhabty\FutureConducteurBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'karhabty_futureconducteurbundle_question';
    }


}
