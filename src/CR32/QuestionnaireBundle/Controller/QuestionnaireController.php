<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use CR32\QuestionnaireBundle\Entity\Danses;
use CR32\QuestionnaireBundle\Entity\Contact;

use CR32\QuestionnaireBundle\Form\DansesType;
use CR32\QuestionnaireBundle\Form\ContactType;

class QuestionnaireController extends Controller
{
  public function indexAction(Request $request)
  {
    // Création du formulaire
    $form = $this->createForm(DansesType::class);

    // Test si l'a été envoyé
    if ($request->isMethod('POST') && $form->handleRequest($request))
    {
        
        // Récupération des champs dans data.
        $datas = $form->getData();

        // Accés au repository
        $em = $this->getDoctrine()->getManager();
        $advertRepository = $em->getRepository('CR32QuestionnaireBundle:Danses');

        //Déclaration de la session
        $session = $request->getSession();


        //récupération du service
        $formdanses = $this->container->get('cr32_questionnaire.dansesAction');
        $zerodanses = $formdanses->dansesAction($datas, $session, $em);

        //test si au moins une danse à été soumise
        if($zerodanses==false)
        {
          //une danse à au moins été votée
          $session->set('danses', true);
          return $this->redirectToRoute('cr32_questionnaire_subscription');
        }   

        //zéro danse votée
        $session->set('danses', false);     
    }

    return $this->render('CR32QuestionnaireBundle:Questionnaire:index.html.twig', array('form' => $form->createView()));
  }

  public function subscriptionAction(Request $request)
  {
    $session = $request->getSession();
    $sessionDanse = $session->get('danses');

    if($sessionDanse === true)
    {
      //Déclaration de l'entité
      $contact = new Contact;

      //Création du formulaire
      $form = $this->createForm(ContactType::class, $contact);

      if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
      {
        // Récupération du service
        $contactAction = $this->container->get('cr32_questionnaire.contactAction');

        //Formatage du texte
        $formatageName = $contactAction->formatage($contact->getName());
        $contact->setName($formatageName);

        $formatageSurname = $contactAction->formatage($contact->getSurname());
        $contact->setSurname($formatageSurname);

         // Accés au repository
          $em = $this->getDoctrine()->getManager();
          $advertRepository = $em->getRepository('CR32QuestionnaireBundle:Danses');

        //Vérification si contact unique
        $uniqueContact = $contactAction->uniqueContact($contact);

        $session = $request->getSession();

        if($uniqueContact==true){
            $em->persist($contact);
            $em->flush();

            $session->getFlashBag()->add('add', 'Votre participation a bien été enregistrée');
            return $this->redirectToRoute('cr32_questionnaire_thanks');
        }
        else {
            $session->getFlashBag()->add('noUnique', 'Vous avez déjà participer !');

            return $this->redirectToRoute('cr32_questionnaire_thanks');
        }
      }
      return $this->render('CR32QuestionnaireBundle:Questionnaire:subscription.html.twig', array('form' => $form->createView()));
    }
    else {
      $session->getFlashBag()->add('noDanse', 'Vous devez envoyé(e) une danse pour accéder à la page abonnement');

      $session->remove('danses');
      
      return $this->redirectToRoute('cr32_questionnaire_home');     
    }
    
  }

  public function thanksAction(Request $request)
  {
    $request->getSession()->remove('danses');
  	return $this->render('CR32QuestionnaireBundle:Questionnaire:thanks.html.twig');
  }
}