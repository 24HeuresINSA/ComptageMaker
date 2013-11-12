<?php

namespace ComptageMaker\ComptageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TextController extends Controller
{
    public function homeAction()
    {
        return $this->render('ComptageMakerComptageBundle:Text:home.html.twig');
    }


}
