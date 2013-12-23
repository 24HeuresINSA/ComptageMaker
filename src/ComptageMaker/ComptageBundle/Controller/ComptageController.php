<?php

namespace ComptageMaker\ComptageBundle\Controller;

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

    public function removeAction($id)
    {
        $count = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($id);
        $em = $this->getDoctrine()->getManager();
        foreach($count->getSessions() as $session)
        {
            foreach($session->getInscrits() as $inscrit)
            {
                $session->removeInscrit($inscrit);
                $em->remove($inscrit);
            }
            $session->setPlage(null);
            $count->removeSession($session);
            $em->remove($session);
        }
        $em->remove($count);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }
}