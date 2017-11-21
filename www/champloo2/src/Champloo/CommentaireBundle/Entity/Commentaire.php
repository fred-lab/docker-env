<?php

namespace Champloo\CommentaireBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Champloo\CommentaireBundle\Entity\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Champloo\SiteBundle\Entity\Article", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="Champloo\UserBundle\Entity\User", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\Length(
     *       min=3, 
     *       max=10000,
     *       minMessage = "Le contenu doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu doit faire au maximum {{ limit }} caractères",
     *       )
     */
    private $contenu;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="auteur", type="string", length=70)
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")    
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $datecreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moderer", type="boolean", nullable=true)
     */
    private $moderer;

    /**
     * @var integer
     *
     * @ORM\Column(name="thread_id", type="smallint", nullable=true)
     */
    private $threadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="contenu_abusif", type="smallint", nullable=true)
     */
    private $contenuAbusif;

    /**
     * @var string
     *
     * @ORM\Column(name="vote", type="string", length=255, nullable=true)
     */
    private $vote;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="integer", nullable=true)
     */
    private $referenceId;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Commentaire
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set moderer
     *
     * @param boolean $moderer
     *
     * @return Commentaire
     */
    public function setModerer($moderer)
    {
        $this->moderer = $moderer;

        return $this;
    }

    /**
     * Get moderer
     *
     * @return boolean
     */
    public function getModerer()
    {
        return $this->moderer;
    }

    /**
     * Set threadId
     *
     * @param integer $threadId
     *
     * @return Commentaire
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * Get threadId
     *
     * @return integer
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * Set contenuAbusif
     *
     * @param integer $contenuAbusif
     *
     * @return Commentaire
     */
    public function setContenuAbusif($contenuAbusif)
    {
        $this->contenuAbusif = $contenuAbusif;

        return $this;
    }

    /**
     * Get contenuAbusif
     *
     * @return integer
     */
    public function getContenuAbusif()
    {
        return $this->contenuAbusif;
    }

    /**
     * Set vote
     *
     * @param string $vote
     *
     * @return Commentaire
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return string
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set referenceId
     *
     * @param integer $referenceId
     *
     * @return Commentaire
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    /**
     * Get referenceId
     *
     * @return integer
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set article
     *
     * @param \Champloo\SiteBundle\Entity\Article $article
     *
     * @return Commentaire
     */
    public function setArticle(\Champloo\SiteBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Champloo\SiteBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set user
     *
     * @param \Champloo\UserBundle\Entity\User $user
     *
     * @return Commentaire
     */
    public function setUser(\Champloo\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Champloo\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

}
