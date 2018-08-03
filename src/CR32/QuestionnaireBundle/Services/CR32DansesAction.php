<?php

namespace CR32\QuestionnaireBundle\Services;

Class CR32DansesAction
{
	public function dansesAction($datas, $session, $em, $danses){

		$null=true;

        foreach($datas as $data)
        {
          if($data == null && $null!=false)
          {
            $null=true;
          }
          else{ $null=false; }
        }

        if($null==true)
        {
        	 $session->getFlashBag()->add('noDanse', 'Vous devez donnez au moins une danse');

            // Envoie vers la page de formulaire si non soumis
            return $null;
        }

        else {
        	foreach($datas as $data)
	        {
	          if($data != null)
	          {
	          	// remplace les à par a
	          	$data = str_replace("à", "a", $data);
	          	// mise en minuscule
	          	$data = strtolower($data);
	          	//suppression des caractéres spéciaux
	          	$data = preg_replace("#[^a-zA-Z0-9éè ]#", "", $data);

	          	// récupération de la clé""
	          	$key = key($datas);
	          	$key = preg_replace("#[^a-zA-Z]#", "", $key);

	          	//On met le nom de la danses dans l'entité
	          	$danses->setTitre($data);


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

	          	$em->persist($danses);
				$em->flush();

	          }
	        }
        }


	}
}