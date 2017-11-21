<?php
// src/Champloo/SiteBundle/Controller/ArticleController.php

namespace Champloo\SiteBundle\Controller;

use Champloo\UserBundle\Entity\User;

use Champloo\SiteBundle\Entity\Article;
use Champloo\SiteBundle\Entity\ArticleRepository;
use Champloo\SiteBundle\Form\ArticleType;

use Champloo\CommentaireBundle\Entity\Commentaire;
use Champloo\CommentaireBundle\Form\CommentaireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Article controller.
 */
class ArticleController extends Controller
{
    /**
    * Fonction permettant de lister les articles dans le sommaire "article"
    */
    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 8;

        $listArticle = $this->getDoctrine()
                            ->getManager()
                            ->getRepository("ChamplooSiteBundle:Article")
                            ->getArticles($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listArticle)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
       }

    return $this->render('ChamplooSiteBundle:Article:index.html.twig', array(
        'listArticle' => $listArticle,
        'page' => $page,
        'nbPages' => $nbPages,
        ));
    }

    /**
    * Lire un article et ses commentaires associés
    * @ParamConverter("article", options={"mapping": {"article_slug": "slug"}})
    */
    public function lireAction(Article $article)
    {
        return $this->render('ChamplooSiteBundle:Article:lire.html.twig', array(
            'article' => $article,
            ));
    }
    
     /**
     * Ajoute un article
     * @Security("has_role('ROLE_REDACTEUR')")
     */
    public function ajouterAction(Request $request)
    {
        // création d'un objet Article
        $article = new Article(); 

        // récupération de l'ID de l'utilisateur
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        // création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new ArticleType(), $article);

        // liaison entre l'utilisateur et l'article.
        $article->setUser($user);

        // donne à la variable auteur le nom utilisateur
        $article->setAuteur($user);

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
         
            $request->getSession()->getFlashbag()->add('notice', 'Article bien enregistrée.');
            
            return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' => 
                $article-> getSlug())));
        }

        return $this->render('ChamplooSiteBundle:Article:ajouter.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    /**
     * Editer un article
     * @ParamConverter("article", options={"mapping": {"article_slug": "slug"}})
     */
    public function editerAction(Article $article, Request $request) 
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new ArticleType(), $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();

            $request->getSession()->getFlashbag()->add('notice', 'Article modifié.');

            return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' => 
            $article-> getSlug())));
        }

        $this->denyAccessUnlessGranted('editer', $article, 'Vous ne possédez pas les droits nécessaire pour réaliser cette action !');

        return $this->render('ChamplooSiteBundle:Article:editer.html.twig', array(
            'form' => $form->createView(),
            'article' => $article
        ));
    }

    /**
     * Supprimer un article
     * @ParamConverter("article", options={"mapping": {"article_slug": "slug"}})
     */
    public function supprimerAction(Article $article, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // création d'un formulaire vide pour la protection CSRF
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($article);
            $em->flush();

            $request->getSession()->getFlashbag()->add('info', 'Article supprimée.');

            return $this->redirect($this->generateUrl('champloo_site_homepage'));
        }

        $this->denyAccessUnlessGranted('editer', $article, 'Vous ne possédez pas les droits nécessaire pour réaliser cette action !');

        return $this->render('ChamplooSiteBundle:Article:supprimer.html.twig', array(
            'form' => $form->createView(),
            'article' => $article
        ));
    }
}

