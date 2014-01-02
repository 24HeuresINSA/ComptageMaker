<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Form\SessionType;
use ComptageMaker\ComptageBundle\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfoxny\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class SessionController extends Controller
{
    public function createAction(Request $request, $comptageId)
    {
        $session = new Session();
        $form = $this->createForm(new SessionType(),$session);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $comptage = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($comptageId);
                $this->getDoctrine()->getManager()->persist($session);
                $comptage->addSession($session);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:session.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request,$id)
    {
        $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($id);
        $form = $this->createForm(new SessionType,$session);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:session.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction($id,$comptageId)
    {
        $comptage = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($comptageId);
        $session =  $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($id);
        $em = $this->getDoctrine()->getManager();
        if($comptage->getSessions()->contains($session))
        {
            $comptage->removeSession($session);
            foreach($session->getInscrits() as $inscrit)
            {
                $inscrit->setAssociation(null);
                $session->removeInscrits($inscrit);
                $em->flush();
                $em->remove($inscrit);
            }
            $em->remove($session);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_dashboard'));
        }
        return $this->render('ComptageMakerComptageBundle:Admin:dashboard.html.twig');
    }

    public function showListInscritsAction($id)
    {
        $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($id);
        return $this->render('ComptageMakerComptageBundle:Admin:listInscrits.html.twig', array(
            'inscrits' => $session->getInscrits(),
        ));
    }
}