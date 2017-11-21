<?php
// src/Champloo/TaxonomieBundle/Controller/SmartlinkController.php

namespace Champloo\TaxonomieBundle\Controller;

use Champloo\TaxonomieBundle\Entity\Terme;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Smartlink controller.
 *
 * Système permettant de remplacer un mot clé par une url
 * pour accéder plus facilement à son contenu lié.
 *
 */
class SmartlinkController extends Controller
{
	public function smartLinkAction()
	{
		$em = $this->getDoctrine()->getManager();

		$repo = $em->getRepository('ChamplooTaxonomieBundle:Terme')
				   ->myFindSmartLink();

				 // dump($repo);
	    
	    // die();
		
		$texte ='Le japon et sa ville de toto et de supertoto, célébre pour ses test de type shonen';	
		
		$tableauReplace = array();

		foreach ($repo as $row){	
		  $tableauReplace['title'] = $row['title'];
    		}
    
	    dump($tableauReplace);
	    
	    die();


		// var_dump($repo);
		// die();

		// foreach ($repo as $row){		
		// $keyword = array($row['title']);
		// var_dump($keyword);
		// die();

		// $lien = $row['lien'];
		
		// $smartlink = preg_replace($keyword, $lien, $texte);
		// }
		

		// while ($keyword = $repo) {
		// 	$row = array();
		// 	$row[] = $keyword->title;
		// }
		

		var_dump($smartlink);
		die();

		$link =		   	

		$smartlink = preg_replace($keyword, $link, $texte);

		

		return $this->render("ChamplooTaxonomieBundle:Taxonomie:test.html.twig", array(
			'repo'=>$repo
			));
	}

}