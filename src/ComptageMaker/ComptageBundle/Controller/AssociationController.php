<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\Association;
use ComptageMaker\ComptageBundle\Form\AssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AssociationController extends Controller
{
    public function createAction(Request $request)
    {
        $association = new Association();
        $form = $this->createForm(new AssociationType(),$association);
        $form->handleRequest($request);
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                $this->getDoctrine()->getManager()->persist($association);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Admin:association.html.twig');
    }

    public function removeAction($id)
    {
        $association = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Association')->find($id);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }
}