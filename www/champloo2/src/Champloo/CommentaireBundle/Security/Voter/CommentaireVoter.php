<?php
// src/Champloo/CommentaireBundle/Security/Voter/CommentaireVoter.php

namespace Champloo\CommentaireBundle\Security\Voter;

use Champloo\UserBundle\Entity\User;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentaireVoter extends AbstractVoter
{
	const CREER = 'creer';
	const EDITER = 'editer';
	const SUPPRIMER = 'supprimer';

	protected function getSupportedAttributes()
	{
		return array(self::CREER, self::EDITER, self::SUPPRIMER);
	}

	protected function getSupportedClasses()
	{
		return array('Champloo\CommentaireBundle\Entity\Commentaire');
	}

	protected function isGranted($attribute, $commentaire, $user = null)
	{
		if (!$user instanceof UserInterface)
		{
			return false;
		}

		switch ($attribute) {
			case self::CREER:
				if ($attribute === self::CREER && in_array('ROLE_USER', $user->getRoles(),true))
				{
					return true;
				}
				break;

			case  self::EDITER:
				if ($attribute === self::EDITER && $user->getUsername() === $commentaire->getAuteur()
					or
					$attribute === self::EDITER && in_array('ROLE_MODERATEUR', $user->getRoles(),true))
				{
					return true;
				}				
				break;	

			case  self::SUPPRIMER:
				if ($attribute === self::SUPPRIMER && $user->getUsername() === $commentaire->getAuteur()
					or
					$attribute === self::SUPPRIMER && in_array('ROLE_MODERATEUR', $user->getRoles(),true))
				{
					return true;
				}				
				break;
		}

		return false;
	}
}