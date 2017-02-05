<?php

namespace Karhabty\FutureConducteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyFutureConducteurBundle:Default:index.html.twig');
    }
}
