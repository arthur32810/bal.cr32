<?php

namespace CR32\QuestionnaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use CR32\QuestionnaireBundle\Entity\Danses;
use CR32\QuestionnaireBundle\Form\DansesEditType;

class AdministrationController extends Controller
{
	public function adminAction()
	{
		//vue d'administration
		return $this->render('CR32QuestionnaireBundle:Administration:index.html.twig');
	}

	public function dansesAction($niveau)
	{
		var_dump($niveau);
		//récupération du répository
		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('CR32QuestionnaireBundle:Danses');

		if($niveau >= 1 && $niveau <=4)
		{
			$listDanses = $repository->selectNiveau($niveau);
		}
		else 
		{
			//récupération de toutes les données de la table
		  	$listDanses = $repository->myFindAll();
		}

		return $this->render('CR32QuestionnaireBundle:Administration:danses.html.twig', array('listDanses' => $listDanses));
	}

	public function editDanseAction(Danses $danse, Request $request)
	{
		$form = $this->get('form.factory')->create(DansesEditType::class, $danse);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('success', 'Danse bien modifiée.');
      		return $this->redirectToRoute('cr32_administration_danses');
		}

		return $this->render('CR32QuestionnaireBundle:Administration:edit.html.twig', array('form'=>$form->createView()));
	}

	public function deleteDanseAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$danse = $em->getRepository('CR32QuestionnaireBundle:Danses')->find($id);

		if(null === $danse)
		{
			throw new NotFoundHttpException("La danse d'id ".$id." n'existe pas.");
		}

		$em->remove($danse);
		$em->flush();

		$request->getSession()->getFlashBag()->add('success', 'Danse bien supprimée.');
		return $this->redirectToRoute('cr32_administration_danses');
	}

	public function contactsAction()
	{
		$em = $this->getDoctrine()->getManager();

		$listContacts = $em->getRepository('CR32QuestionnaireBundle:Contact')->findAll();

		return $this->render('CR32QuestionnaireBundle:Administration:contacts.html.twig', array('listContacts'=> $listContacts));
	}

	public function deleteContactAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$contact = $em->getRepository('CR32QuestionnaireBundle:Contact')->find($id);

		if(null === $contact)
		{
			throw new NotFoundHttpException("Le contact d'id ".$id." n'existe pas.");
		}

		$em->remove($contact);
		$em->flush();

		$request->getSession()->getFlashBag()->add('success', 'Contact bien suprimé.');

		return $this->redirectToRoute('cr32_administration_contacts');
	}
}