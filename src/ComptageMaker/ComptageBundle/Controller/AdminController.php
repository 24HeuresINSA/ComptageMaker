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
}
