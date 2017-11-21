<?php

namespace Champloo\TaxonomieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Terme
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="Taxonomie_Terme")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @ORM\Entity(repositoryClass="Champloo\TaxonomieBundle\Entity\TermeRepository")
 */
class Terme
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=75, unique=true)
     */
    private $title;

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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;


    /**
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Terme", inversedBy="enfant")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     *
     * @ORM\OneToMany(targetEntity="Terme", mappedBy="parent")
     * @ORM\OrderBy({"treeLeft" = "ASC"})
     */
    private $enfant;

    /**
     * @var integer
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="treeLeft", type="integer")
     */
    private $treeLeft;

    /**
     * @var integer
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="treeRight", type="integer")
     */
    private $treeRight;

    /**
     * @var integer
     *
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @var integer
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;

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
     * Set title
     *
     * @param string $title
     *
     * @return Terme
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * Set enfant
     *
     * @param string $enfant
     *
     * @return Terme
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
     * Set treeLeft
     *
     * @param integer $treeLeft
     *
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * @return Terme
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
     * Constructor
     */
    public function __construct()
    {
        $this->enfant = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Terme
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Add enfant
     *
     * @param \Champloo\TaxonomieBundle\Entity\Terme $enfant
     *
     * @return Terme
     */
    public function addEnfant(\Champloo\TaxonomieBundle\Entity\Terme $enfant)
    {
        $this->enfant[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \Champloo\TaxonomieBundle\Entity\Terme $enfant
     */
    public function removeEnfant(\Champloo\TaxonomieBundle\Entity\Terme $enfant)
    {
        $this->enfant->removeElement($enfant);
    }
}
