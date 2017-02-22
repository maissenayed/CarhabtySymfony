<?php

namespace Karhabty\MailBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder

            ->add('nom')

            ->add('prenom')

            ->add('tel')

            ->add('from')

            ->add('text')

            ->add('valider',SubmitType::class) ;




    }

    public function configureOptions(OptionsResolver $resolver)
    {






    }

    public function getName()
    {
        return 'karhabty_mail_bundle_mail';
    }
}
