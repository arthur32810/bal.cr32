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
  	return $this->render('CR32QuestionnaireBundle::subscription.html.twig');
  }

  public function thanksAction()
  {
  	return $this->render('CR32QuestionnaireBundle::thanks.html.twig');
  }
}