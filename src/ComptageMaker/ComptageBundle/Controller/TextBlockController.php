<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\TextBlock;
use ComptageMaker\ComptageBundle\Form\TextBlockType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TextBlockController extends Controller
{
    public function homeAction()
    {
        $textblocks = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:TextBlock')->findAll();
        return $this->render('ComptageMakerComptageBundle:Text:home.html.twig', array(
            'textblocks' => $textblocks,
        ));
    }

    public function createAction(Request $request)
    {
        $textblock = new TextBlock();
        $form = $this->createForm(new TextBlockType(),$textblock);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($textblock);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:textblock.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request,$id)
    {
        $textblock = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:TextBlock')->find($id);
        $form = $this->createForm(new TextBlockType(),$textblock);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:textblock.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction($id)
    {
        $textblock = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:TextBlock')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($textblock);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }

}
