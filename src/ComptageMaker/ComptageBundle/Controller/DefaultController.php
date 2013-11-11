<?php

namespace ComptageMaker\ComptageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ComptageMakerComptageBundle:Default:index.html.twig', array('name' => $name));
    }
}
