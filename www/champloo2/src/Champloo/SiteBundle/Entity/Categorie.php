<?php

namespace Champloo\SiteBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Champloo\SiteBundle\Entity\CategorieRepository")
 * @UniqueEntity(fields="nom", message="Une catégorie existe déjà avec ce titre.")
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="Champloo\SiteBundle\Entity\Article", mappedBy="categorie")
     * 
     */
    protected $articles;

    /**
     * @ORM\OneToMany(targetEntity="Champloo\SiteBundle\Entity\sousCategorie", mappedBy="categorie")
     */
    private $sousCategories;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25, nullable=false, unique=true)
     * @Assert\Length(
     *       min=3, 
     *       max=25, 
     *       minMessage = "Le nom doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le nom doit faire au maximum {{ limit }} caractères",
     *       )
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")     
     * @ORM\Column(name="Date_Ajout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")     
     * @ORM\Column(name="Date_Modification", type="datetime")
     */
    private $dateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="createur", type="string", length=25, nullable=false)
     * @Assert\Length(
     *       min=2, 
     *       max=25,
     *       minMessage = "Le nom d'utilisateur doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le nom d'utilisateur doit faire au maximum {{ limit }} caractères",     
     *       )
     */
    private $createur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "La description doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "La description doit faire au maximum {{ limit }} caractères",
     *       )
     */
    private $description;

    /**
     * 
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(length=128, nullable=false, unique=true)
     */
    private $slug;

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
     * Set Nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set sousCategorie
     *
     * @param string $sousCategorie
     *
     * @return Categorie
     */
    public function setSousCategorie($sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;

        return $this;
    }

    /**
     * Get sousCategorie
     *
     * @return string
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Categorie
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Categorie
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set createur
     *
     * @param string $createur
     *
     * @return Categorie
     */
    public function setCreateur($createur)
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * Get createur
     *
     * @return string
     */
    public function getCreateur()
    {
        return $this->createur;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sousCategory
     *
     * @param \Champloo\SiteBundle\Entity\sousCategorie $sousCategory
     *
     * @return Categorie
     */
    public function addSousCategory(\Champloo\SiteBundle\Entity\sousCategorie $sousCategory)
    {
        $this->sousCategories[] = $sousCategory;

        // liaison des 2 entitées
        $sousCategory->setCategorie($this);

        return $this;
    }

    /**
     * Remove sousCategory
     *
     * @param \Champloo\SiteBundle\Entity\sousCategorie $sousCategory
     */
    public function removeSousCategory(\Champloo\SiteBundle\Entity\sousCategorie $sousCategory)
    {
        $this->sousCategories->removeElement($sousCategory);
    }

    /**
     * Get sousCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousCategories()
    {
        return $this->sousCategories;
    }

    /**
     * Add article
     *
     * @param \Champloo\SiteBundle\Entity\Article $article
     *
     * @return Categorie
     */
    public function addArticle(\Champloo\SiteBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        // liaison des 2 entités
        $article->setCategorie($this);

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
     * Set slug
     *
     * @param string $slug
     *
     * @return Categorie
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
