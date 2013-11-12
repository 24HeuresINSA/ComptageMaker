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
            $session->remove(SecurityContext::AUTHENTICATION_ERROR); // TODO : maybe to remove?

            return $this->render('ComptageMakerComptageBundle:Admin:login.html.twig',
                array(
                    //last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME)
                )
            );
        }

    }
}
