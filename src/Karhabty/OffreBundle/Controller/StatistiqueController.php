<?php

namespace Karhabty\OffreBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Json\Expr;

class StatistiqueController extends Controller
{


    public function chartAction()
    {


        $em = $this->getDoctrine()->getManager();
     //   $nbrUser = $em->getRepository('KarhabtyUserBundle:User')->countUser();
        $nbrCoupon = $em->getRepository('KarhabtyOffreBundle:Coupon')->countCoupon();
    //    $nbrOffre = $em->getRepository('KarhabtyOffreBundle:Offre')->countAllOffre();
         //$nbrAnnonces = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countAnnonce();
    //    $annoncesnow = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countannoncenew();
      //  $annonceslast = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->countannoncelastweek();
        $couponnow =$em->getRepository('KarhabtyOffreBundle:Coupon')->countCouponnew();
        $couponlast =$em->getRepository('KarhabtyOffreBundle:Coupon')->countCouponlast();

        $tab=array();$category=array();$coupon=array();
        array_push($category,"last day");
        array_push($category,"this day");
      //  array_push($tab,(int)$annonceslast);
        //array_push($tab,(int)$annoncesnow);
        array_push($coupon,(int)$couponlast);
        array_push($coupon,(int)$couponnow);
        $series = array(

            array('name' => "nombre de coupons", 'type' => 'area', 'color' => '#fffff','yAxis' => 1,  'data' => $coupon));
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
                'title' => array('text' => "coupons", 'style' => array('color' => '#fffff')),),

        );
        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('line');
        $ob->title->text('coupons achetés');
        $ob->xAxis->categories($category);
        $ob->yAxis($yData);
        $ob->legend->enabled(true);
        $formatter = new Expr('function () { var unit = { "coupon": "coupons" }[this.series.name]; return this.x + ": " + this.y + " " + unit; }');
        $ob->tooltip->formatter($formatter);
        $ob->series($series);
        return $this->render('@KarhabtyOffre/offre/statistique.html.twig', array(
            'chart' => $ob,
            "nbrCoupon"=>$nbrCoupon,
          //  "nbrAnnonce"=>$nbrAnnonces,
           // "nbrOffre"=>$nbrOffre,
           // "nbrUser"=>$nbrUser

        ));





    }



}