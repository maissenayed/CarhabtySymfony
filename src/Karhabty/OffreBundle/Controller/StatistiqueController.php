<?php

namespace Karhabty\OffreBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller
{


    public function chartAction()
    {
        // Chart

          $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('KarhabtyOffreBundle:Offre')->countStat($this->getUser());

        $series = array(

            array("name" => "Data Serie Name",
                "data" => array(1,2,4,5,6,3,8)
            )

        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "date d'achat"));
        $ob->yAxis->title(array('text'  => "nombre de coupon achetés"));
        $ob->series($series);

        return $this->render('@KarhabtyOffre/offre/statistique.html.twig', array(
            'chart' => $ob
        ));
    }


    public function StatAction()
    {
        return $this->render('@KarhabtyOffre/offre/statistique.html.twig');
    }

}