<?php

namespace Karhabty\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{



    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
           return $this->redirectToRoute("fos_user_profile_show");
        }
        
        return $this->render('home_layout.html.twig');
    }

    public function userAction()
    {
        $user=$this->getUser();
        $this->denyAccessUnlessGranted('ROLE_PARTICULER', $user, 'Unable to access this page!');
        return $this->render('KarhabtyUserBundle::HomeUser.html.twig');
    }


    public function partenaireAction()
    {
        $user=$this->getUser();
        $this->denyAccessUnlessGranted('ROLE_PARTENAIRE', $user, 'Unable to access this page!');
        return $this->render('KarhabtyUserBundle::HomePartner.html.twig');
    }
}
