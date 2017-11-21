<?php
// src/Champloo/UserBundle/Entity/User.php


namespace Champloo\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 */
class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\OneToMany(targetEntity="Champloo\SiteBundle\Entity\Article", mappedBy="user")
   * 
   */
  protected $articles;

  /**
   * @ORM\OneToMany(targetEntity="Champloo\CommentaireBundle\Entity\Commentaire", mappedBy="user")
   * 
   */
  protected $commentaires;  

  public function __construct()
  {
    $this->articles = new ArrayCollection(); 

    $this->commentaires = new ArrayCollection();
  }

  /**
   * Add article
   *
   * @param \Champloo\SiteBundle\Entity\Article $article
   *
   * @return User
   */
  public function addArticle(\Champloo\SiteBundle\Entity\Article $article)
  {
      $this->articles[] = $article;

      $article->setUser($this);
      
      return $this;
  }

  /**
   * Remove article
   *
   * @param \Champloo\SiteBundle\Entity\Article $article
   */
  public function removeArticle(\Champloo\SiteBundle\Entity\Article $article)
  {
      $this->articles->removeElement($article);
  }

  /**
   * Get articles
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getArticles()
  {
      return $this->articles;
  }

    /**
     * Add commentaire
     *
     * @param \Champloo\CommentaireBundle\Entity\Commentaire $commentaire
     *
     * @return User
     */
    public function addCommentaire(\Champloo\CommentaireBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        $commentaires->setUser($this);

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Champloo\CommentaireBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Champloo\CommentaireBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
