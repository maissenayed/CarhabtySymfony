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
       // $now = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('KarhabtyUserBundle:User')->findAll();

        $e =array();
            foreach ($offres as $of ){

                $e[]=[$of->getAdresse(), $of->getActivite()];



            }


        return $this->render('KarhabtyMapBundle:Map:filter.html.twig',array('offres' => $e));
    }








}
