<?php

namespace ComptageMaker\ComptageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class AdminController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();


        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            return $this->render('ComptageMakerComptageBundle:Admin:login.html.twig',
                array(
                    //last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'         => "Login/Mdp invalide"
                )
            );
        } else {
            return $this->render('ComptageMakerComptageBundle:Admin:login.html.twig',
                array(
                    //last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME)
                )
            );
        }

    }

    public function dashBoardAction()
    {
        $plages = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Plage')->findAll();
        $sessions = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->findAll();
        $comptages = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->findAll();
        $textblocks = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:TextBlock')->findAll();
        $associations = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Association')->findAll();

        return $this->render('ComptageMakerComptageBundle:Admin:dashboard.html.twig',
            array('plages' => $plages, 'sessions' => $sessions, 'comptages' => $comptages, 'textblocks' => $textblocks, 'associations' => $associations));
    }

    public function guideAction()
    {
        return $this->render('ComptageMakerComptageBundle:Admin:guide.html.twig');
    }

    public function mailAction($inscritId)
    {
        $inscrit = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Inscrit')->find($inscritId);
        $message = \Swift_Message::newInstance();
        $message->setSubject('Confirmation d\'inscription à comptages.24heures.org')
            ->setTo($inscrit->getMail())
            ->setBody(
                $this->renderView(
                    'ComptageMakerComptageBundle:Admin:confirm.html.twig',
                    array('inscrit' => $inscrit, 'session' => $session)
                ),'text/html'
            );
        $this->get('mailer')->send($message);
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }

    public function sessionMailAction($id)
    {
        $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($id);
        /*$array = [];
        foreach($session->getInscrits() as $inscrit)
        {
            $array[] = $inscrit->getMail();
        }
        $message = \Swift_Message::newInstance();
        $message->setSubject('Confirmation d\'inscription à comptages.24heures.org')
            ->setTo($array)
            ->setBody(
                $this->renderView(
                    'ComptageMakerComptageBundle:Admin:confirm.html.twig',
                    array('inscrit' => $inscrit, 'session' => $session)
                ),'text/html'
            );
        $this->get('mailer')->send($message);*/
        $string = '';
        foreach($session->getInscrits() as $inscrit)
        {
            $string = $string.$inscrit->getMail().';';
        }
        return $this->redirect('https://mail.google.com/mail/?view=cm&fs=1&tf=1&source=mailto&to='.$string);
    }

    public function sessionAutoMailAction($id)
    {
        $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($id);
        $array = [];
        foreach($session->getInscrits() as $inscrit)
        {
            $array[] = $inscrit->getMail();
        }
        $message = \Swift_Message::newInstance();
        $message->setSubject('Confirmation d\'inscription à comptages.24heures.org')
            ->setTo($array)
            ->setBody(
                $this->renderView(
                    'ComptageMakerComptageBundle:Admin:confirm.html.twig',
                    array('inscrit' => $inscrit, 'session' => $session)
                ),'text/html'
            );
        $this->get('mailer')->send($message);
    }
}
