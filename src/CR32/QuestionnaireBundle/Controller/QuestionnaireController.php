<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class QuestionnaireController extends Controller
{
  public function indexAction()
  {
    return $this->render('CR32QuestionnaireBundle::index.html.twig');
  }

  public function subscriptionAction()
  {
  	return new Response(" abonnement ");
  }

  public function thanksAction()
  {
  	return new Response(" merci !");
  }
}