<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends Controller
{
	public function adminAction()
	{
		return new Response('vous êtes sur admin');
	}
}