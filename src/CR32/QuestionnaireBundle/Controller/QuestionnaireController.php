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
    $danses =  new Danses;
    $form = $this->createForm(DansesType::class, $danses);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    {
      return new Response('complete');
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