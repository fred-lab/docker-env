<?php
// src/Champloo/SiteBundle/Controller/CategorieController.php

namespace Champloo\SiteBundle\Controller;

use Champloo\SiteBundle\Entity\Categorie;
use Champloo\SiteBundle\Entity\CategorieRepository;
use Champloo\SiteBundle\Entity\sousCategorie;
use Champloo\SiteBundle\Entity\sousCategorieRepository;

use Champloo\SiteBundle\Form\CategorieType;
use Champloo\SiteBundle\Form\sousCategorieType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie controller.
 */
class CategorieController extends Controller
{
	/**
    * Fonction permettant de lister les catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function indexCategorieAction()
    {
       	$em = $this->getDoctrine()->getManager();

    	// $categories = $em->getRepository('ChamplooSiteBundle:Categorie')
     //                    ->findall();

        $categories = $em->getRepository('ChamplooSiteBundle:Categorie')
        					->myFindCategorie();
        // var_dump($sousCategories);
        // die();

    	return $this->render('ChamplooSiteBundle:Categorie:indexCategorie.html.twig', array(
    		'categories' => $categories,
    		// 'sousCategories'=> $sousCategories
    		));
    }

	/**
    * Fonction permettant de créer des catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function ajouterCategorieAction(Request $request)
    {
    	$categorie = new Categorie();

    	// création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new CategorieType(), $categorie);

    	// récupération de l'ID de l'utilisateur et association de l'utilisateur 
    	// avec la variable createur
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $categorie->setCreateur($user);

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
         
            $request->getSession()->getFlashbag()->add('notice', 'Categorie bien enregistrée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:ajouterCategorie.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    /**
    * Fonction permettant d'éditer le contenu des catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("categorie", options={"mapping": {"categorie_slug": "slug"}})
    */
    public function editerCategorieAction(Request $request, Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CategorieType(), $categorie);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashbag()->add('notice', 'Catégorie modifiée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:editerCategorie.html.twig', array(
            'form' => $form->createView(),
            'categorie' => $categorie
        ));
    }

    /**
    * Fonction permettant de supprimer le contenu des catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("categorie", options={"mapping": {"categorie_slug": "slug"}})
    */
    public function supprimerCategorieAction(Request $request, Categorie $categorie)
    {
    	$em = $this->getDoctrine()->getManager();

        // création d'un formulaire vide pour la protection CSRF
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($categorie);
            $em->flush();

            $request->getSession()->getFlashbag()->add('info', 'Catégorie supprimée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:supprimerCategorie.html.twig', array(
            'form' => $form->createView(),
            'categorie' => $categorie
        ));
    }

	/**
    * Fonction permettant de créer des sous-catégories pour les catégorie d'articles
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function ajouterSousCategorieAction(Request $request)
    {
    	$sousCategorie = new SousCategorie();

    	// création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new SousCategorieType(), $sousCategorie);

    	// récupération de l'ID de l'utilisateur et association de l'utilisateur 
    	// avec la variable createur
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $sousCategorie->setCreateur($user);

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousCategorie);
            $em->flush();
         
            $request->getSession()->getFlashbag()->add('notice', 'Sous-Categorie bien enregistrée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:ajouterSousCategorie.html.twig', array(
            'form' => $form->createView(),
            ));
    }  

    /**
    * Fonction permettant d'éditer le contenu des sous-catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("sousCategorie", options={"mapping": {"sous_categorie_slug": "slug"}})
    */
    public function editerSousCategorieAction(Request $request, sousCategorie $sousCategorie)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new SousCategorieType(), $sousCategorie);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashbag()->add('notice', 'Sous-catégorie modifiée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:editerSousCategorie.html.twig', array(
            'form' => $form->createView(),
            'sousCategorie' => $sousCategorie
        ));
    }

    /**
    * Fonction permettant de supprimer le contenu des sous-catégories d'articles
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("sousCategorie", options={"mapping": {"sous_categorie_slug": "slug"}})
    */
    public function supprimerSousCategorieAction(Request $request, sousCategorie $sousCategorie)
    {
        $em = $this->getDoctrine()->getManager();

        // création d'un formulaire vide pour la protection CSRF
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($sousCategorie);
            $em->flush();

            $request->getSession()->getFlashbag()->add('info', 'Sous-catégorie supprimée.');

            return $this->redirect($this->generateUrl('champloo_site_categorie_index'));
        }

        return $this->render('ChamplooSiteBundle:Categorie:supprimerSousCategorie.html.twig', array(
            'form' => $form->createView(),
            'sousCategorie' => $sousCategorie
        ));
    }
}