<?php 
// src/Champloo/Userbundle/Controller/SecurityController.php;

namespace Champloo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class SecurityController extends Controller
{
	public function loginAction(Request $request)
	{
		// si le visiteur est déjà identifié, on le redirige vers l'accueil
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			return $this->redirectToRoute('champloo_site_homepage');
		}

		// Le service authentification_utils permet de récupérer le nom de l'ulisateur
		// et l'erreur dans le cas om le formulaire a déjà été soumis mais était invalide
		// (mauvais mot de passe par exemple)
		$authenticationUtils = $this->get('security.authentication_utils');

		return $this->render('ChamplooUserBundle:Security:login.html.twig', array(
		'last_username' => $authenticationUtils->getLastUsername(),
   		'error'         => $authenticationUtils->getLastAuthenticationError(),
		 	));
		}
	}
