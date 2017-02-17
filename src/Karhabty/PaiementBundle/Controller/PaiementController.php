<?php

namespace Karhabty\PaiementBundle\Controller;

use Karhabty\OffreBundle\Entity\Offre;
use Nomaya\SocialBundle\DependencyInjection\NomayaSocialExtension;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class PaiementController extends Controller
{
    public function paiementAction(Offre $offre,Request $request)
    {

        dump($offre);
        die;

        if ($request->isXmlHttpRequest()) {

            $card = $request->request->get('card');
            $exp = $request->request->get('exp');
            $cvc = $request->request->get('cvc');


            $em = $this->getDoctrine()->getManager();


            $verif = $em->getRepository('KarhabtyBankBundle:Card')->findBy(array('numCard'=>$card,'cvc'=>$cvc,'expdate'=>$exp));

            if($verif == null){

                return new JsonResponse(array('status' => 'faild'));

            }


          return new JsonResponse(array('status' => 'success'));


        }


        return $this->render('@KarhabtyPaiement/Default/paiement.html.twig',array(
        'offre' => $offre));


    }
}