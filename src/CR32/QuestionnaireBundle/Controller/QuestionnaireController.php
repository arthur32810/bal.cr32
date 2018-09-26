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
        $danses = $form->getData();        

        //Déclaration de la session
        $session = $request->getSession();

        //récupération du service
        $formdanses = $this->container->get('cr32_questionnaire.dansesAction');
        $zeroDanse  = $formdanses->zeroDanse($danses);

        var_dump($zeroDanse);

        //test si au moins une danse à été soumise
        if($zeroDanse==false)
        {
          //une danse à au moins été votée
          $session->set('danses', $danses);
          return $this->redirectToRoute('cr32_questionnaire_subscription');
        }  
        else 
        {
           $session->getFlashBag()->add('noDanse', 'Vous devez donnez au moins une danse pour que votre vote soit pris en compte');
            //zéro danse votée
            $session->set('danses', false);  
        } 
    }

    return $this->render('CR32QuestionnaireBundle:Questionnaire:index.html.twig', array('form' => $form->createView()));
  }

  public function subscriptionAction(Request $request)
  {
    $session = $request->getSession();
    $danses = $session->get('danses');

    if(!empty($danses))
    {
      //Déclaration de l'entité
      $contact = new Contact;

      //Création du formulaire
      $form = $this->createForm(ContactType::class, $contact);

      if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
      {
        // Récupération des services
        $contactAction = $this->container->get('cr32_questionnaire.contactAction');
        $danseAction   = $this->container->get('cr32_questionnaire.dansesAction');

        //Vérification si le contact est unique
        $uniqueContact = $contactAction->uniqueContact($contact);

        if($uniqueContact === true)
        {
          //Formatage du texte
          $formatageName = $contactAction->formatage($contact->getName());
          $contact->setName($formatageName);

          $formatageSurname = $contactAction->formatage($contact->getSurname());
          $contact->setSurname($formatageSurname);

           // Accés au repository
            $em = $this->getDoctrine()->getManager();
            $advertRepository = $em->getRepository('CR32QuestionnaireBundle:Danses');

          //Vérification si email unique pour la country Rebell's Letter
          $uniqueEmail = $contactAction->uniqueEmail($contact);

          if($uniqueEmail == true)
          {
            $session->getFlashBag()->add('success', 'Vous êtes bien inscrit à notre Country Rebell\'s Letter');
          }
          else
          {
            $session->getFlashBag()->add('alert', 'Votre adresse mail est déjà enregistrée dans la liste de diffusion de la Country Rebell\'s Letter');
          }
              
          $session = $request->getSession();

          // Accés au repository
          $em = $this->getDoctrine()->getManager();
          $advertRepository = $em->getRepository('CR32QuestionnaireBundle:Danses');

          //Persist danses
          $danseAction->dansesAction($danses, $session, $em);
          //Perist contact
          $em->persist($contact);
          $em->flush();

          $session->getFlashBag()->add('success', 'Votre participation a bien été enregistrée');
          return $this->redirectToRoute('cr32_questionnaire_thanks');
          }
          else {
              $session->getFlashBag()->add('alert', 'Vous avez déjà participer ! Votre vote n\'as pas été pris en compte');

              return $this->redirectToRoute('cr32_questionnaire_thanks');
          }
        }
      return $this->render('CR32QuestionnaireBundle:Questionnaire:subscription.html.twig', array('form' => $form->createView()));
    }
    else {
      $session->getFlashBag()->add('noDanse', 'Vous devez envoyé(e) une danse pour que votre vote soit pris en compte');

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