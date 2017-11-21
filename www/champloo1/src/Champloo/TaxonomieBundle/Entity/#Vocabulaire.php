<?php

namespace Champloo\TaxonomieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vocabulaire
 *
 * @ORM\Table(name="Taxonomie_Vocabulaire")
 * @ORM\Entity(repositoryClass="Champloo\TaxonomieBundle\Entity\VocabulaireRepository")
 */
class Vocabulaire
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
     *
     * @ORM\OneToMany(targetEntity="Champloo\TaxonomieBundle\Entity\Terme", mappedBy="vocabulaire", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $termes;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=75)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="createur", type="string", length=75)
     */
    private $createur;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update") 
     * @ORM\Column(name="datemodification", type="datetime")
     */
    private $dateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Vocabulaire
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
     * Set description
     *
     * @param string $description
     *
     * @return Vocabulaire
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
     * Set createur
     *
     * @param string $createur
     *
     * @return Vocabulaire
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Vocabulaire
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
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Vocabulaire
     */
    public function setDatemodification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->dateModification;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Vocabulaire
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

    /**
     * Set parent
     *
     * @param string $parent
     *
     * @return Vocabulaire
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set treeLeft
     *
     * @param integer $treeLeft
     *
     * @return Vocabulaire
     */
    public function setTreeLeft($treeLeft)
    {
        $this->treeLeft = $treeLeft;

        return $this;
    }

    /**
     * Get treeLeft
     *
     * @return integer
     */
    public function getTreeLeft()
    {
        return $this->treeLeft;
    }

    /**
     * Set treeRight
     *
     * @param integer $treeRight
     *
     * @return Vocabulaire
     */
    public function setTreeRight($treeRight)
    {
        $this->treeRight = $treeRight;

        return $this;
    }

    /**
     * Get treeRight
     *
     * @return integer
     */
    public function getTreeRight()
    {
        return $this->treeRight;
    }

    /**
     * Set root
     *
     * @param integer $root
     *
     * @return Vocabulaire
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Vocabulaire
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return integer
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set enfant
     *
     * @param string $enfant
     *
     * @return Vocabulaire
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return string
     */
    public function getEnfant()
    {
        return $this->enfant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->termes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add terme
     *
     * @param \Champloo\TaxonomieBundle\Entity\Terme $terme
     *
     * @return Vocabulaire
     */
    public function addTerme(\Champloo\TaxonomieBundle\Entity\Terme $terme)
    {
        $this->termes[] = $terme;

        // liaison du vocabulaire au terme
        $terme->setVocabulaire($this);

        return $this;
    }

    /**
     * Remove terme
     *
     * @param \Champloo\TaxonomieBundle\Entity\Terme $terme
     */
    public function removeTerme(\Champloo\TaxonomieBundle\Entity\Terme $terme)
    {
        $this->termes->removeElement($terme);
    }

    /**
     * Get termes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTermes()
    {
        return $this->termes;
    }
}
