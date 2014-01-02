<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\Comptage;
use ComptageMaker\ComptageBundle\Form\ComptageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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

    public function editAction(Request $request,$id)
    {
        $count = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($id);
        $form = $this->createForm(new ComptageType, $count);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:comptage.html.twig',array(
            'form' => $form->createView(),
        ));
    }

    public function createAction(Request $request)
    {
        $count = new Comptage();
        $form = $this->createForm(new ComptageType(),$count);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($count);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:comptage.html.twig',array(
            'form' => $form->createView(),
        ));
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
                $em->flush();
                $em->remove($inscrit);
            }
            $session->setPlage(null);
            $count->removeSession($session);
            $em->flush();
            $em->remove($session);
        }
        $em->remove($count);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }
}