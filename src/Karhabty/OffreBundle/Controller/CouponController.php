<?php

namespace Karhabty\OffreBundle\Controller;

use Karhabty\OffreBundle\Entity\Coupon;
use Karhabty\OffreBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CouponController extends Controller
{
    function indexAction(Offre $offre)
    {

       return $this->render('@KarhabtyOffre/coupon/coupon.html.twig', array(
            'offre' => $offre

        ));


    }



    function generateAction(Request $request){

                $coupon = new Coupon();
                $coupon->setUser($this->getUser());
                if($request->isMethod('POST')){

                    $idof=$request->request->get('idoffre');
                    $random = random_int(1, 200);
                    $coupon->setReference("RFCC".''.$random);
                    $em = $this->getDoctrine()->getManager();
                    $offre = $em->getRepository("KarhabtyOffreBundle:Offre")->find($idof);
                    $coupon->setOffre($offre);
                    $em->persist($coupon);
                    $em->flush();
        }





        return $this->render('@KarhabtyOffre/offre/paiement.html.twig',array());




    }




    public function returnPDFResponseFromHTML($html){

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetTitle(('generation du coupon'));
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'coupon';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I');
    }








    public function testAction(){


        $em = $this->getDoctrine()->getManager();
        $coupon = $em->getRepository('KarhabtyOffreBundle:Coupon')->getCouponInformation();




        $qrcode = "test";
        // but in this case we will render a symfony view !
        // We are in a controller and we can use renderView function which retrieves the html from a view
        // then we send that html to the user.
        $html = $this->renderView('@KarhabtyOffre/coupon/GenerationCoupon.html.twig',array('alo'=>$qrcode));

        $this->returnPDFResponseFromHTML($html);
    }







}
