<?php
// src/Champloo/TaxonomieBundle/Controller/TaxonomieController.php

namespace Champloo\TaxonomieBundle\Controller;

use Champloo\TaxonomieBundle\Entity\Terme;

use Champloo\TaxonomieBundle\Form\TermeType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Categorie controller.
 *
 * Système de taxonomie permettant la gestion du contenu d'un site.
 * La taxonomie est constitué d'un Vocabulaire, recensant des Termes.
 * Chaque vocabulaire peut contenir plusieurs termes
 *
 */
class TaxonomieController extends Controller
{
	/**
    * Fonction permettant de lister les taxonomies
    * @Security("has_role('ROLE_ADMIN')")
    *
    */
    public function indexTaxonomieAction()
    {
        $em = $this->getDoctrine()->getManager();

        $termes = $em->getRepository('ChamplooTaxonomieBundle:Terme')
                     ->findAll();
        // var_dump($termes);
        //              die();
    	return $this->render("ChamplooTaxonomieBundle:Taxonomie:indexTaxonomie.html.twig", array(
            'termes' => $termes
            ));
    }

    /**
    * Fonction permettant d'ajouter des vocabulaires. 
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function ajouterVocabulaireAction(Request $request)
    {
        $vocabulaire = new Terme();

        // création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new TermeType(), $vocabulaire);
        
        // récupération de l'ID de l'utilisateur et association de l'utilisateur 
        // avec la variable createur
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $vocabulaire->setCreateur($user);

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vocabulaire);
            $em->flush();
         
            $request->getSession()->getFlashbag()->add('notice', 'vocabulaire bien enregistrée.');

            return $this->redirect($this->generateUrl('champloo_taxonomie_index'));
        }

        return $this->render('ChamplooTaxonomieBundle:Taxonomie:ajouterVocabulaire.html.twig', array(
            'form' => $form->createView(),
            ));

    }

    /**
    * Fonction permettant d'ajouter des termes. 
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("terme", options={"mapping": {"terme_slug": "slug"}})    
    */
    public function ajouterTermeAction(Request $request, Terme $terme)
    {
        // création du terme "enfant" avec la variable $child
        $child = new Terme();

        // création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new TermeType(), $child);

        // récupération de l'ID de l'utilisateur et association de l'utilisateur 
        // avec la variable createur
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $child->setCreateur($user);

        // association du terme "enfant" ($child) avec son "parent" contenu dans l'instance
        // Terme $terme
        $child->setParent($terme);

        // var_dump($child);
        // die();

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($child);
            $em->flush();
         
            $request->getSession()->getFlashbag()->add('notice', 'Terme bien enregistrée.');

            return $this->redirect($this->generateUrl('champloo_taxonomie_index'));
        }

        return $this->render('ChamplooTaxonomieBundle:Taxonomie:ajouterTerme.html.twig', array(
            'form'  => $form->createView(),
            'terme' => $terme
            ));

    }

    /**
    * Fonction permettant d'editer des termes. 
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("terme", options={"mapping": {"terme_slug": "slug"}}) 
    */
    public function editerTermeAction(Request $request, Terme $terme)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new TermeType(), $terme);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashbag()->add('notice', 'Terme modifié.');

            return $this->redirect($this->generateUrl('champloo_taxonomie_index'));
        }

        return $this->render('ChamplooTaxonomieBundle:Taxonomie:editerTerme.html.twig', array(
            'form' => $form->createView(),
            'terme' => $terme
        ));
    }

    /**
    * Fonction permettant de supprimer des termes. 
    * @Security("has_role('ROLE_ADMIN')")
    * @ParamConverter("terme", options={"mapping": {"terme_slug": "slug"}}) 
    */
    public function supprimerTermeAction(Request $request, Terme $terme)
    {
        $em = $this->getDoctrine()->getManager();

        // création d'un formulaire vide pour la protection CSRF
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($terme);
            $em->flush();

            $request->getSession()->getFlashbag()->add('info', 'Terme supprimé.');

            return $this->redirect($this->generateUrl('champloo_taxonomie_index'));
        }

        return $this->render('ChamplooTaxonomieBundle:Taxonomie:supprimerTerme.html.twig', array(
            'form' => $form->createView(),
            'terme' => $terme
        ));
    }
}


