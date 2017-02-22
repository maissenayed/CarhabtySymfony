<?php

namespace Karhabty\OffreBundle\Controller;

use Karhabty\OffreBundle\Entity\Coupon;
use Karhabty\OffreBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;


class CouponController extends Controller
{
    function indexAction(Offre $offre)
    {

       return $this->render('@KarhabtyOffre/coupon/coupon.html.twig', array(
            'offre' => $offre

        ));


    }


    function generateAction(Request $request){
        if ($request->isXmlHttpRequest()) {
                $coupon = new Coupon();
                $coupon->setUser($this->getUser());




                    $idof=$request->request->get('id');

                    $random = random_int(1, 400);
                    $coupon->setReference("RFCC".''.$random);

                    $em = $this->getDoctrine()->getManager();
                    $offre = $em->getRepository("KarhabtyOffreBundle:Offre")->find($idof);



                    $coupon->setOffre($offre);
                   //echo $coupon->getOffre()->getPrix();die;
                    $em->persist($coupon);
                    $em->flush();

            return new JsonResponse(array('status' => 'success'));
        }


         return new JsonResponse(array('status' => 'faild'));


    }




    public function successAction(){


            return $this->render('@KarhabtyOffre/coupon/GenerationCoupon.html.twig');


    }



    public function returnPDFResponseFromHTML($html){

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetTitle(('generation du coupon'));
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();


        // Change the path to whatever you like, even public:// will do or you could also make use of the private file system by using private://
        $path =  'Carhabty';

// Supply a filename including the .pdf extension

        $filename = 'Coupon.pdf';
// Create the full path

        $full_path = $path .''. $filename;




        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
      return  $pdf->Output($full_path,'D');
    }








    public function testAction(){



           $user = $this->getUser();
           $em = $this->getDoctrine()->getManager();
           $coupon = $em->getRepository('KarhabtyOffreBundle:Coupon')->findOneBy(array('user'=>$user),array('date'=>'DESC'));


            $prix = $coupon->getOffre()->getPrix();
            $nom= $coupon->getUser()->getNom();
            $prenom =$coupon->getUser()->getPrenom();
            $ref = $coupon->getReference();
            $nomoffre= $coupon->getOffre()->getnomOffre();
            $reduction= $coupon->getOffre()->getTauxReduction();
            $adresse=$coupon->getOffre()->getUser()->getAdresse();
            $partenaire=$coupon->getOffre()->getUser()->getNomsociete();

            $prixfinal= $prix -(($prix*$reduction)/100);

          //  echo  $nomoffre.'----'.$nom.'---'.$prenom.'---'.$prixfinal.'----'.$ref.'----'.$reduction.'%'.'----'.$adresse;die;


        // but in this case we will render a symfony view !
        // We are in a controller and we can use renderView function which retrieves the html from a view
        // then we send that html to the user.
        $html = $this->renderView('@KarhabtyOffre/coupon/GenerationCouponPDF.html.twig',array('ref'=>$ref ,'nom'=>$nom,'prenom'=>$prenom
        ,'prix'=>$prixfinal,'offre'=>$nomoffre,'adresse'=>$adresse,'part'=>$partenaire));

        $this->returnPDFResponseFromHTML($html);
    }





    public function MesCouponAction(){


        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $coupon = $em->getRepository('KarhabtyOffreBundle:Coupon')->MesCoupon($user);





       return $this->render('@KarhabtyOffre/coupon/MesCoupon.html.twig',array('coup'=>$coupon));


    }




}
