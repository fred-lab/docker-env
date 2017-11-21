<?php
// src/Champloo/CommentaireBundle/Controller/CommentaireController.php

namespace Champloo\CommentaireBundle\Controller;

use Champloo\UserBundle\Entity\User;
use Champloo\SiteBundle\Entity\Article;
use Champloo\CommentaireBundle\Entity\Commentaire;

use Champloo\CommentaireBundle\Form\CommentaireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Forms;

/**
 * Commentaire controller.
 */
class CommentaireController extends Controller
{
    /**
     * Présente un formulaire vide pour enregister un commentaire sur un article
     *
     * @ParamConverter("article", class="ChamplooSiteBundle:Article", options={"article_slug" = "slug"})
     */
    public function formCommentaireAction(Article $article)
    {
        $commentaire = new Commentaire();
        $commentaire->setArticle($article);
        $form = $this->createForm(new CommentaireType(), $commentaire);

        return $this->render('ChamplooCommentaireBundle::form.html.twig', array(
            'article' => $article,
            'form' => $form->createView()
            ));
    }

    /**
     * Liste tout les commentaires d'un article
     *
     * @ParamConverter("article", class="ChamplooSiteBundle:Article", options={"article_slug" = "slug"})
     */
    public function indexCommentaireAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        // liste des commentaires par article
        $commentaires = $em->getRepository('ChamplooCommentaireBundle:Commentaire')
                         ->findByArticleListeCommentaire($article->getId());

        return $this->render('ChamplooCommentaireBundle::commentaire.html.twig', array(
            'article' => $article,
            'commentaire' => $commentaires
            ));
    }

     /**
     * Ajoute un commentaire
     *
     * @ParamConverter("article", class="ChamplooSiteBundle:Article", options={"article_slug" = "slug"})
     * @Security("has_role('ROLE_USER')")
     */
    public function ajouterCommentaireAction(Article $article, Request $request)
    {
    	// création de l'entité commentaire
        $commentaire = new Commentaire;

        // récupération du nom de l'utilisateur (id)      
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // liaison des entités
        $commentaire->setArticle($article);
        $commentaire->setUser($user);

         // association du nom de l'utilisateur avec l'attribut Auteur
    	$commentaire->setAuteur($user);

        // création du formBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(new CommentaireType(), $commentaire);

        if ($form->handleRequest($request)->isvalid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            
            $request->getSession()->getFlashbag()->add('notice', 'Commentaire bien enregistré.');
            
            return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' => 
                $article-> getSlug()))
                .'#comment'.$commentaire->getId());        
            }

        // en cas d'erreur
        $this->get('session')->getFlashBag()->add('error', 'Votre formulaire contient des erreurs');

        // On réaffiche le formulaire sans redirection (sinon on perd les informations du formulaire)
        return $this->forward('ChamplooSiteBundle:Article:lire', array(
            'article' => $article,
            'form'    => $form->createView(),
        ));
    }

    /**
    * Modifier un commentaire
    * 
    */
    public function editerCommentaireAction(Request $request, Commentaire $commentaire)  
    {
        //appel le service security_check pour vérifier les droits de l'utilisateur.
        $security = $this->get('app_security_check')->checkUser($commentaire->getAuteur());

        if ($security === true)
        {
            $em = $this->getDoctrine()->getManager();

            $form = $this->createForm(new CommentaireType(), $commentaire);
            // vérifie si le formulaire est valide et enregistre le commentaire modifié
            if ($form->handleRequest($request)->isValid()) {
                $em->flush();

                $request->getSession()->getFlashbag()->add('notice', 'Commentaire modifié.');

                return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' => 
                    $commentaire->getArticle()-> getSlug()
                    )));
            }

            return $this->render('ChamplooCommentaireBundle::editerCommentaire.html.twig', array(
                'form' => $form->createView(),
                'commentaire' => $commentaire
            ));
        }
        // si l'utilisateur n'a pas les droits, il est renvoyé vers la page de l'article
        return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' => 
                    $commentaire->getArticle()-> getSlug()
                    )));
    } 

    /**
    * Supprimer un commentaire
    */
    public function supprimerCommentaireAction(Request $request, Commentaire $commentaire)
    {
        //appel le service security_check pour vérifier les droits de l'utilisateur.
        $security = $this->get('app_security_check')->checkUser($commentaire->getAuteur());

        if ($security === true)
        {
            $em = $this->getDoctrine()->getManager();

            // création d'un formulaire vide pour la protection CSRF
            $form = $this->createFormBuilder()->getForm();

            if ($form->handleRequest($request)->isValid()) {
                $em->remove($commentaire);
                $em->flush();

                $request->getSession()->getFlashbag()->add('info', 'Commentaire supprimé.');

                return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' =>
                    $commentaire->getArticle()->getSlug()
                )));
            }

            return $this->render('ChamplooCommentaireBundle::supprimerCommentaire.html.twig', array(
                'form' => $form->createView(),
                'commentaire' => $commentaire
            ));
        }

        // si l'utilisateur n'a pas les droits, il est renvoyé vers la page de l'article
        return $this->redirect($this->generateUrl('champloo_site_article_lire', array('article_slug' =>
            $commentaire->getArticle()-> getSlug()
        )));
    }
}
