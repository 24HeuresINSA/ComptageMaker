<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\Plage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ComptageController extends Controller
{

    public function listCountAction()
    {
        $counts = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->findAll();
        return $this->render('ComptageMakerComptageBundle:Comptage:listCount.html.twig', array('counts' => $counts));
    }

    public function changeStatusAction($id)
    {
        $count = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($id);
        $newStatus = !($count->getEtat());
        $count->setEtat($newStatus);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect($this->generateUrl('comptage_list'));
    }

    public function editAction($id)
    {
        //formulaire
    }

    public function createAction()
    {
        //formulaire
    }
}