<?php

namespace Karhabty\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyMailBundle:Default:index.html.twig');
    }
}
