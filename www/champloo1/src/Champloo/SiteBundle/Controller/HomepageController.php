<?php

namespace Champloo\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChamplooSiteBundle:Homepage:index.html.twig');
    }
}
