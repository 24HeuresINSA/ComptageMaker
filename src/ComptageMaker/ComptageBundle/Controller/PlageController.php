<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Form\PlageType;
use ComptageMaker\ComptageBundle\Entity\Plage;
use ComptageMaker\ComptageBundle\Entity\Comptage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PlageController extends Controller
{
    public function createAction(Request $request)
    {
        $plage = new Plage();
        $form = $this->createForm(new PlageType(),$plage);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($plage);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:plage.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request,$id)
    {
        $plage = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Plage')->find($id);
        $form = $this->createForm(new PlageType(), $plage);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:plage.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction($id)
    {
        $plage = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Plage')->find($id);
        $sessions = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->findAll();
        $em = $this->getDoctrine()->getManager();
        foreach($sessions as $session)
        {
            if($session->getPlage == $plage)
            {
                $session->setPlage(null);
            }
        }
        $em->flush();
        $em->remove($plage);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }
}