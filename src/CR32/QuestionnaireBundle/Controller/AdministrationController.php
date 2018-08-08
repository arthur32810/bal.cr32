<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdministrationController extends Controller
{
	public function adminAction()
	{
		return $this->render('CR32QuestionnaireBundle:Administration:index.html.twig');
	}

	public function dansesAction()
	{
		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('CR32QuestionnaireBundle:Danses');

		  $listDanses = $repository->findAll();

		return $this->render('CR32QuestionnaireBundle:Administration:danses.html.twig', array('listDanses' => $listDanses));
	}

	public function deleteDanseAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$danse = $em->getRepository('CR32QuestionnaireBundle:Danses')->find($id);

		if(null === $danse)
		{
			throw new NotFoundHttpException("La danse d'id ".$id." n'existe pas.");
		}

		$em->remove($danse);
		$em->flush();

		return $this->redirectToRoute('cr32_administration_danses');
	}

	public function contactsAction()
	{
		$em = $this->getDoctrine()->getManager();

		$listContacts = $em->getRepository('CR32QuestionnaireBundle:Contact')->findAll();

		return $this->render('CR32QuestionnaireBundle:Administration:contacts.html.twig', array('listContacts'=> $listContacts));
	}

	public function deleteContactAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$contact = $em->getRepository('CR32QuestionnaireBundle:Contact')->find($id);

		if(null === $contact)
		{
			throw new NotFoundHttpException("Le contact d'id ".$id." n'existe pas.");
		}

		$em->remove($contact);
		$em->flush();

		return $this->redirectToRoute('cr32_administration_contacts');
	}
}