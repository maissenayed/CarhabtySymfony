<?php

namespace Karhabty\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('@KarhabtyAdmin/index.html.twig', array('name' => "ldvhhds"));
    }




    public function chartAction()
    {

        $em = $this->getDoctrine()->getManager();
        $nbrUser = $em->getRepository('KarhabtyUserBundle:User')->countUser();
        $nbrCoupon = $em->getRepository('KarhabtyOffreBundle:Coupon')->countCoupon();
        $nbrOffre = $em->getRepository('KarhabtyOffreBundle:Offre')->countAllOffre();
        $nbrAnnonces = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countAnnonce();
        $annoncesnow = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countannoncenew();
        $annonceslast = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countannoncelastweek();
        $couponnow =$em->getRepository('KarhabtyOffreBundle:Coupon')->countCouponnew();
        $couponlast =$em->getRepository('KarhabtyOffreBundle:Coupon')->countCouponlast();

        $tab=array();$category=array();$coupon=array();
               array_push($category,"last day");
               array_push($category,"this day");
               array_push($tab,(int)$annonceslast);
               array_push($tab,(int)$annoncesnow);
               array_push($coupon,(int)$couponlast);
               array_push($coupon,(int)$couponnow);
        $series = array(
            array('name' => "date d'annonce", 'type' => 'area', 'color' => '#4572A7',  'data' => $tab),
            array('name' => "date d'coupon", 'type' => 'line', 'color' => '#fffff',  'data' => $coupon));
        $yData = array(
            array('labels' =>
                array('formatter' => new Expr('function () { return this.value + "" }'),
                    'style' => array('color' => '#4572A7')),
                'gridLineWidth' => 0,
                'title' => array('text' => "nombre d'annonce créé", 'style' => array('color' => '#4572A7')),),

            array('labels' =>
                array('formatter' => new Expr('function () { return this.value + "" }'),
                    'style' => array('color' => '#fffff')),
                'gridLineWidth' => 0,
                'title' => array('text' => "nombre d'coupon créé", 'style' => array('color' => '#fffff')),),

                      );
        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('area');
        $ob->title->text(' Annonce créé');
        $ob->xAxis->categories($category);
        $ob->yAxis($yData);
        $ob->legend->enabled(false);
        $formatter = new Expr('function () { var unit = { "annonces": "annonces(s)", }[this.series.name]; return this.x + ": <b>" + this.y + "</b> " + unit; }');
        $ob->tooltip->formatter($formatter);
        $ob->series($series);
        return $this->render('@KarhabtyAdmin/index.html.twig', array(
            'chart' => $ob,
            "nbrCoupon"=>$nbrCoupon,
            "nbrAnnonce"=>$nbrAnnonces,
            "nbrOffre"=>$nbrOffre,
            "nbrUser"=>$nbrUser

        ));











    }
}
