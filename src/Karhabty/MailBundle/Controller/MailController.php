<?php

namespace Karhabty\MailBundle\Controller;

use Karhabty\MailBundle\Entity\Mail;
use Karhabty\MailBundle\Form\MailType;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction() {

        return $this->render('KarhabtyMailBundle:Mail:mail.html.twig');


    }


    public function newAction(Request $request) {

        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
        $form->handleRequest($request) ;


        if ($form->isValid()) {

            $this->sendMailAction($mail->getFrom(), $mail-> getFrom(), $mail->getNom(), $mail->getText());

        }

        return $this->render('KarhabtyMailBundle:Mail:new.html.twig', array('form' => $form->createView())) ; }






    public function sendMailAction(Request $request) {

        $to = "";
        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
        $form->handleRequest($request) ;

        if ($form->isValid()) {




            $message = Swift_Message::newInstance()

                ->setSubject($mail->getNom())

                ->setFrom($mail-> getFrom())

                ->setTo($to)

                ->setBody($mail->getText());


            try {
                if ($this->get('mailer')->send($message)){

                    return $this->render('KarhabtyMailBundle:Mail:mail.html.twig', array('to' => $to,

                        'from' => $mail-> getFrom()

                    ));

                }

            } catch (Exception $e) {

                $e->getMessage();
            }






        }

        return $this->redirect($this->generateUrl('my_app_mail_form'));


    }
}
