<?php

namespace Karhabty\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyMapBundle:Map:map.html.twig');
    }
}
