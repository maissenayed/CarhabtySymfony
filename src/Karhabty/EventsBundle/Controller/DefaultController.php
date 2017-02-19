<?php

namespace Karhabty\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyEventsBundle:Default:index.html.twig');
    }
}
