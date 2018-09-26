<?php

namespace CR32\QuestionnaireBundle\Services;

use CR32\QuestionnaireBundle\Entity\Danses;

Class CR32DansesAction
{
	public function zeroDanse($danses)
	{
		//initialisation de la variable null à vrai
		$null=true;

		//recherche de données
        foreach($danses as $danse)
        {	
        	//si une donnée est nulle
          if($danse == null && $null!=false)
          {
            $null=true;
          }
          else{ $null=false; }
        }

        return $null;
	}

	public function dansesAction($datas, $session, $em){

        	foreach($datas as $data)
	        {
	          if($data != null)
	          {

	          	$danses = new Danses();

	          	// remplace les à par a
	          	$data = str_replace("à", "a", $data);

	          	//suppression des caractéres spéciaux
	          	$data = preg_replace("#[^a-zA-Z0-9éè ]#", "", $data);



	          	// récupération de la clé
	          	$key = array_search($data, $datas);
	          	$key = preg_replace("#[^a-zA-Z]#", "", $key);

	          	switch($key)
	          	{
	          		case 'debutant':
	          			$niveau = 1;
	          			break;
	          		case 'novice':
	          			$niveau = 2;
	          			break;
	          		case 'intermediaire':
	          			$niveau = 3;
	          			break;
	          		case 'avance':
	          			$niveau = 4;
	          			break;
	          	}

	          	//insertion du niveau dans l'entité
	          	$danses->setNiveau($niveau);

	          	// mise en minuscule
	          	$data = strtolower($data);

	          	//On met le nom de la danses dans l'entité
	          	$danses->setTitre($data);

	          	$em->persist($danses);
				$em->flush();

	          }
	        }
        }


	}