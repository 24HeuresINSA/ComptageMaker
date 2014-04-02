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
    public function createAction(Request $request, $sessionId, $countId)
    {
        $inscrit = new Inscrit();
        $form = $this->createForm(new InscritType(),$inscrit);
        $form->handleRequest($request);
        $errorList = null;
        if($request->getMethod() == 'POST')
        {
            if($form->isValid())
            {
                if($form->get('association')->getData() == null && $form->get('nassociation')->getData() != null)
                {
                    $association = new Association();
                    $association->setName($form->get('nassociation')->getData());
                    $this->getDoctrine()->getManager()->persist($association);
                    $inscrit->setAssociation($association);
                }
                elseif($form->get('association')->getData() == null && $form->get('nassociation')->getData() == null)
                {
                    return $this->redirect($this->generateUrl('inscrit_create'));
                }

                //mail à comptages
                $message = \Swift_Message::newInstance();
                $message->setSubject('Confirmation d\'inscription à comptages.24heures.org')
                    ->setTo('comptages@24heures.org')
                    ->setFrom($inscrit->getMail());

                //si on s'inscrit à une seule session
                if(is_numeric($sessionId))
                {
                    $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($sessionId);
                    $session->addInscrit($inscrit);
                    $message->setBody(
                    $this->renderView(
                        'ComptageMakerComptageBundle:Admin:newUser.html.twig',
                        array('inscrit' => $inscrit, 'session' => $session)
                    ),'text/html'
                );
                }

                //si on s'inscrit à toutes les sessions du comptage
                else
                {
                    $count = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Comptage')->find($countId);
                    foreach($count->getSessions() as $session)
                    {
                        $session->addInscrit($inscrit);
                    }
                    $message->setBody(
                    $this->renderView(
                        'ComptageMakerComptageBundle:Admin:newUserCount.html.twig',
                        array('inscrit' => $inscrit, 'count' => $count)
                    ),'text/html'
                );
                }

                $this->getDoctrine()->getManager()->persist($inscrit);
                $this->getDoctrine()->getManager()->flush();



                $this->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('comptage_home'));
            }
        }
        return $this->render('ComptageMakerComptageBundle:Comptage:inscrit.html.twig', array(
            'sessionId' => $sessionId,
            'countId' => $countId,
            'form' => $form->createView(),
            'errorList' => $errorList
        ));
    }

    public function removeAction($id,$sessionId)
    {
        $session = $this->getDoctrine()->getRepository('ComptageMakerComptageBundle:Session')->find($sessionId);
        foreach($session->getInscrits() as $inscrit)
        {
            if($inscrit->getId() == $id)
            {
                $session->removeInscrit($inscrit);
                $inscrit->setAssociation(null);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $em->remove($inscrit);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_dashboard'));
            }
        }
        throw $this->createNotFoundException('Inscrit inexistant');
    }
}