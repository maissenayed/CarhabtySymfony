<?php

namespace Karhabty\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KarhabtyMapBundle:Map:map.html.twig');
    }



    public function filterAction()
    {
        $now = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('KarhabtyOffreBundle:Offre')->getadresse($now);


        return $this->render('KarhabtyMapBundle:Map:filter.html.twig',array('offres' => $offres));
    }








}
