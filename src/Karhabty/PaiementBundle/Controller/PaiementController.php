<?php

namespace Karhabty\PaiementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaiementController extends Controller
{
    public function indexAction()
    {




        $stripe = array(
            "secret_key"      => "sk_test_RsxmObm0pom99TkTZl4aORXu",
            "publishable_key" => "pk_test_BPuRjkJzKhfAj7wznkgl16rh"
        );

        \Stripe\Stripe::setApiKey($stripe['publishable_key']);




        return $this->render('@KarhabtyPaiement/Default/index.html.twig');
    }




    public function testAction()
    {



        return $this->render('@KarhabtyPaiement/Default/test.html.twig');
    }



}
