<?php

namespace CR32\QuestionnaireBundle\Services;

use Doctrine\ORM\EntityManagerInterface;

Class CR32ContactAction
{
	private $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}
	// cette fonction va mettre le nom et le prénom en miniscule et sans caractéres spéciaux
	public function formatage($contact)
	{
		$contact = htmlspecialchars($contact);
		//Mise en minuscule
		$contact = strtolower($contact);
		//suppression des caractéres spéciaux
	    $contact = preg_replace("#[^a-zA-Zéè-]#", "", $contact);

		return $contact;
	}

	public function uniqueContact($contact)
	{
		//Récupération du repository
		$repository = $this->em
			->getRepository('CR32QuestionnaireBundle:Contact');

		$name = $contact->getName();
		$surname = $contact->getSurname();

		$unique = $repository->findBy(
			array('name' => $name,
				  'surname' => $surname));

		if(count($unique) >= 1)
		{
			return false;
		}
		else {return true;}
	}
}