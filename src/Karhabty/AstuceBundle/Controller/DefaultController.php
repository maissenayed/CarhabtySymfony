<?php

namespace Karhabty\AstuceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyAstuceBundle:Default:index.html.twig');
    }
}
