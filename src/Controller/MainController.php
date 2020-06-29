<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        
        if($request->isMethod('POST'))
        {
            $name = $request->request->get('name');
            $subject = $request->request->get('Subject');
            $reply = $request->request->get('_replyto');
            $message = $request->request->get('message');

            $mail = (new \Swift_Message($subject))
                ->setFrom($reply)
                ->setTo('aymenradhouen@gmail.com')
                ->setBody($message);

            $mailer->send($mail);
            $this->addFlash('Success', 'Email Sent !');
        }



        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
