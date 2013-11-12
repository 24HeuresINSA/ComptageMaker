<?php

namespace ComptageMaker\ComptageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TextController extends Controller
{
    public function homeAction($id)
    {
        return $this->render('ComptageMakerComptageBundle:Text:home.html.twig');
    }

    public function faqAction($id)
    {
        return $this->render('ComptageMakerComptageBundle:Text:faq.html.twig');
    }

}
