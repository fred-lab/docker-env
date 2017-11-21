<?php
// src/AppBundle/Services/SecurityCheck.php

namespace AppBundle\Services;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

// Vérifie si l'utilisateur a les droits nécessaires pour éditer ou supprimer un contenu
class SecurityCheck 
{
	private $userCredits;

	private $authentification;

	private $requestStack;


	public function __construct($userCredits, $authentification, $requestStack)
	{
		$this->userCredits = $userCredits;
		$this->authentification = $authentification;
		$this->requestStack = $requestStack;
	}

	public function checkUser ($auteur)
	{

		// récupére l'objet Request dans un service.
		$request = $this->requestStack->getCurrentRequest();

		// récupération du nom de l'utilisateur
		$userName = $this->userCredits->getToken()->getUser()->getUsername();

		// récupération des rôles de l'utilisateur
		$userRoles = $this->userCredits->getToken()->getUser()->GetRoles();
		
		// vérifie si l'utilistaeur est connecté.
		if ($this->authentification->isGranted('IS_AUTHENTICATED_FULLY')){

			// vérifie les droits de l'utilisteurs.
			if ($userName === $auteur || (in_array('ROLE_MODERATEUR', $userRoles,true))) {
				return true;	
			} else {
				$request->getSession()->getFlashbag()->add('error', "Vous ne disposez pas des droits nécessaires pour effectuer cette action");

	            return false;
			}	

		} else {
			$request->getSession()->getFlashbag()->add('error', "Vous devez être connecté pour effectuer cette action");

            return false;
		}
	}
}