<?php
// src/Champloo/UserBundle/Security/Voter/ArticleVoter.php

namespace Champloo\SiteBundle\Security;

use Champloo\UserBundle\Entity\User;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleVoter extends AbstractVoter
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
		return array('Champloo\SiteBundle\Entity\Article');
	}

	protected function isGranted($attribute, $article, $user = null)
	{
		if (!$user instanceof UserInterface)
		{
			return false;
		}

		switch ($attribute) {
			case self::CREER:
				if ($attribute === self::CREER && in_array('ROLE_REDACTEUR', $user->getRoles(),true))
				{
					return true;
				}
				break;

			case  self::EDITER:
				if ($attribute === self::EDITER && $user->getUsername() === $article->getAuteur()
					or
					$attribute === self::EDITER && in_array('ROLE_REDACTEUR_CHEF', $user->getRoles(),true))
				{
					return true;
				}				
				break;	

			case  self::SUPPRIMER:
				if ($attribute === self::SUPPRIMER && $user->getUsername() === $article->getAuteur()
					or
					$attribute === self::SUPPRIMER && in_array('ROLE_REDACTEUR_CHEF', $user->getRoles(),true))
				{
					return true;
				}				
				break;
		}

		return false;
	}
}