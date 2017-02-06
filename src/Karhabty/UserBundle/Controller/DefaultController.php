<?php

namespace Karhabty\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{



    public function indexAction()
    {

        return $this->render('home_layout.html.twig');
    }

    public function userAction()
    {

        return $this->render('KarhabtyUserBundle::HomeUser.html.twig');
    }


    public function partenaireAction()
    {
        return $this->render('KarhabtyUserBundle::HomePartner.html.twig');
    }
}
