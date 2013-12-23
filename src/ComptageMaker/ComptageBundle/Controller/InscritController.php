<?php

namespace ComptageMaker\ComptageBundle\Controller;

use ComptageMaker\ComptageBundle\Entity\Association;
use ComptageMaker\ComptageBundle\Form\InscritType;
use ComptageMaker\ComptageBundle\Entity\Inscrit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class InscritController extends Controller
{
    public function createAction(Request $request, $sessionId)
    {
        $inscrit = new Inscrit();
        $form = $this->createForm(new InscritType(),$inscrit);
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if($form->isValid())
            {
                $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($sessionId);
                if($form->get('association')->getData() == null)
                {
                    $association = new Association();
                    $association->setName($form->get('nassociation')->getData());
                    $this->getDoctrine()->getManager()->persist($association);
                    $inscrit->setAssociation($association);
                }
                $session->addInscrit($inscrit);
                $this->getDoctrine()->getManager()->persist($inscrit);
                $this->getDoctrine()->getManager()->flush();
            }
            return $this->redirect($this->generateUrl('comptage_home'));
        }
        return $this->render('ComptageMakerComptageBundle:Comptage:inscrit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeAction($id)
    {
        $inscrit = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Inscrit')->find($id);
        $inscrit->setAssociation(null);
        $em = $this->getDoctrine()->getManager();
        $em->remove($inscrit);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_dashboard'));
    }
}