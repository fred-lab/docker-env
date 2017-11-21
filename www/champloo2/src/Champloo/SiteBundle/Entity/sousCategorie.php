<?php

namespace Champloo\SiteBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * sousCategorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Champloo\SiteBundle\Entity\sousCategorieRepository")
 * @UniqueEntity(fields="nom", message="Une sous-catégorie existe déjà avec ce titre.")
 */
class sousCategorie
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
     * @ORM\ManyToOne(targetEntity="Champloo\SiteBundle\Entity\Categorie", inversedBy="sousCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="createur", type="string", length=70, nullable=false)
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=70, nullable=false, unique=true)
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
     * @ORM\Column(name="datecreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update") 
     * @ORM\Column(name="datemodification", type="datetime")
     */
    private $datemodification;

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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return sousCategorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set createur
     *
     * @param string $createur
     *
     * @return sousCategorie
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
     * @return sousCategorie
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
     * Set nom
     *
     * @param string $nom
     *
     * @return sousCategorie
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return sousCategorie
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
     * Set datemodification
     *
     * @param \DateTime $datemodification
     *
     * @return sousCategorie
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return sousCategorie
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
