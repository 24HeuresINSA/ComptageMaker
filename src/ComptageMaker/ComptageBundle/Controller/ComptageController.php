<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\Plage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ComptageController extends Controller
{

    public function listCountsAction()
    {
        return $this->render('ComptageMakerComptageBundle:Comptage:listCounts.html.twig');
    }

    public function setPlagesAction()
    {
        $a = new Plage();
        $a->setNom('matin')
            ->setDebut(new \DateTime('7:30:00'))
            ->setFin(new \DateTime('9:30:00'));
        $p = new Plage();
        $p->setNom('aprem')
            ->setDebut(new \DateTime('17:00:00'))
            ->setFin(new \DateTime('19:00:00'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($a);
        $em->persist($p);
        $em->flush();

        return new Response('done');
    }

}