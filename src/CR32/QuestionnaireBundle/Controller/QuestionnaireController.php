<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class QuestionnaireController extends Controller
{
  public function indexAction()
  {
    return new Response("accueil");
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