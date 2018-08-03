<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CR32\QuestionnaireBundle\Entity\Danses;
use CR32\QuestionnaireBundle\Form\DansesType;

class QuestionnaireController extends Controller
{
  public function indexAction(Request $request)
  {
    // Création du formulaire
    $form = $this->createForm(DansesType::class);

    // Test si l'a été envoyé
    if ($request->isMethod('POST') && $form->handleRequest($request))
    {
        $danses = new Danses;
        // Récupération des champs dans data.
        $datas = $form->getData();

        // Accés au repository
        $em = $this->getDoctrine()->getManager();
        $advertRepository = $em->getRepository('CR32QuestionnaireBundle:Danses');

        $session = $request->getSession();

        $formdanses = $this->container->get('cr32_questionnaire.dansesAction');

        $formdanses = $formdanses->dansesAction($datas, $session, $em, $danses);

        if($formdanses==false)
        {
          return $this->redirectToRoute('cr32_questionnaire_subscription');
        }        
    }

    return $this->render('CR32QuestionnaireBundle::index.html.twig', array('form' => $form->createView()));
  }

  public function subscriptionAction()
  {
  	return $this->render('CR32QuestionnaireBundle::subscription.html.twig');
  }

  public function thanksAction()
  {
  	return $this->render('CR32QuestionnaireBundle::thanks.html.twig');
  }
}