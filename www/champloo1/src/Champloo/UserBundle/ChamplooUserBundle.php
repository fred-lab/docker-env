<?php
// src/Champloo/UserBundle/ChamplooUserBundle.php

namespace Champloo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChamplooUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}	
}
