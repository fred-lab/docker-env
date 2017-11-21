<?php

namespace Champloo\SiteBundle\Entity;

use Champloo\SiteBundle\Validator as ChamplooAssert;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Article
 *
 * @ORM\Table(name="Site_Article")
 * @ORM\Entity(repositoryClass="Champloo\SiteBundle\Entity\ArticleRepository")
 * @UniqueEntity(fields="titre", message="Un article existe déjà avec ce titre.")
 */
class Article
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
     * @ORM\ManyToOne(targetEntity="Champloo\UserBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

    // *
    //  * @ORM\ManyToOne(targetEntity="Champloo\SiteBundle\Entity\Categorie", inversedBy="articles")
    //  * @ORM\JoinColumn(nullable=false)
    //  * @Assert\Valid()
     
    // private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, unique=true)
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "Le titre doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le titre doit faire au maximum {{ limit }} caractères",
     *       )
     * @Assert\NotBlank(message="Le titre ne peut pas être vide")
     *
     * @Assert\Regex("#[a-zA-Z]{3,}#", 
     *                message="Le titre doit contenir au moins 3 lettres")
     *
     * @Assert\Regex(
     *               pattern="#[-&(-_@)°/*+`^£$%ù<>?,.;:!€]{10,}#",
     *               match=false,
     *               message="Ce titre contient trop de symbole")
     *
     * @Assert\Regex(
     *               pattern="#[§~[\]{}|£¤²]#",
     *               match=false,
     *               message="Le titre ne peut pas contenir ces symboles § ~ [ \ ] { } | £ ¤ ²"
     *              )
     */
    private $titre;

    /**
     * 
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="auteur", type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\Length(
     *       min=3, 
     *       max=30000, 
     *       minMessage = "Le contenu doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu doit faire au maximum {{ limit }} caractères",
     *       )
     * @Assert\NotBlank(message="Le contenu ne peut pas être vide")
     *
     * @Assert\Regex("#[a-zA-Z]{3,}#", 
     *                message="Le contenu doit contenir au moins 3 lettres")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="text", nullable=true)
     * 
     */
    private $tag;

    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\Valid()
     */
    private $image;

    /**
     *
     * @ORM\OneToMany(targetEntity="Champloo\CommentaireBundle\Entity\Commentaire", mappedBy="article")
     * @Assert\Valid()
     */
    private $commentaires;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="datecreation", type="datetime")
     * @Assert\DateTime()
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")   
     * @ORM\Column(name="dateupdated", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateupdated;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     * @Assert\Valid()
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="taxonomie", type="string", length=255, nullable=true)
     * @Assert\Valid()
     */
    private $taxonomie;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publication", type="boolean", length=255, nullable=true)
     */
    private $publication;

    /**
     * @var string
     *
     * @ORM\Column(name="nomfr", type="string", length=255, nullable=true)
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "Le nom français doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le nom français doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $nomfr;

    /**
     * @var string
     *
     * @ORM\Column(name="nomvo", type="string", length=255, nullable=true)
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "Le nom original doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le nom original doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $nomvo;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire", type="string", length=1000, nullable=true)
     * 
     * @Assert\Length(
     *       min=3, 
     *       max=1000, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     */
    private $horaire;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=1000, nullable=true)
     * 
     * @Assert\Length(
     *       min=3, 
     *       max=1000, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", length=255, nullable=true)
     * @Assert\Length(
     *       min=3, 
     *       max=1000, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     * @Assert\Length(
     *       min=3, 
     *       max=1000, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="acces", type="text", length=255, nullable=true)
     * @Assert\Length(
     *       min=3, 
     *       max=1000, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $acces;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     * @Assert\Url(message ="Ce lien {{ value }} n'est pas un lien URL valide",
     *             protocols = {"http", "https", "ftp"})
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(message ="Cette email {{ value }} n'est pas une adresse mail valide")
     * @Assert\Length(
     *       min=3, 
     *       max=255, 
     *       minMessage = "Le contenu de ce champs doit faire au moins {{ limit }} caractères", 
     *       maxMessage = "Le contenu de ce champs doit faire au maximum {{ limit }} caractères",
     *       )
     * 
     */
    private $email;



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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Article
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Article
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Article
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Article
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
     * Set dateupdated
     *
     * @param \DateTime $dateupdated
     *
     * @return Article
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;

        return $this;
    }

    /**
     * Get dateupdated
     *
     * @return \DateTime
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * Set video
     *
     * @param string $video
     *
     * @return Article
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set taxonomie
     *
     * @param string $taxonomie
     *
     * @return Article
     */
    public function setTaxonomie($taxonomie)
    {
        $this->taxonomie = $taxonomie;

        return $this;
    }

    /**
     * Get taxonomie
     *
     * @return string
     */
    public function getTaxonomie()
    {
        return $this->taxonomie;
    }

    /**
     * Set imageFond
     *
     * @param string $imageFond
     *
     * @return Article
     */
    public function setImageFond($imageFond)
    {
        $this->imageFond = $imageFond;

        return $this;
    }

    /**
     * Get imageFond
     *
     * @return string
     */
    public function getImageFond()
    {
        return $this->imageFond;
    }

    /**
     * Set etat
     *
     * @param array $etat
     *
     * @return Article
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return array
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Article
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param \Champloo\UserBundle\Entity\User $user
     *
     * @return Article
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

    /**
     * Set categorie
     *
     * @param \Champloo\SiteBundle\Entity\Categorie $categorie
     *
     * @return Article
     */
    public function setCategorie(\Champloo\SiteBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Champloo\SiteBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Article
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
     * Set publication
     *
     * @param boolean $publication
     *
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commentaire
     *
     * @param \Champloo\CommentaireBundle\Entity\Commentaire $commentaire
     *
     * @return Article
     */
    public function addCommentaire(\Champloo\CommentaireBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        $commentaire->setArticle($this);

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
     * Set nomfr
     *
     * @param string $nomfr
     *
     * @return Article
     */
    public function setNomfr($nomfr)
    {
        $this->nomfr = $nomfr;

        return $this;
    }

    /**
     * Get nomfr
     *
     * @return string
     */
    public function getNomfr()
    {
        return $this->nomfr;
    }

    /**
     * Set nomvo
     *
     * @param string $nomvo
     *
     * @return Article
     */
    public function setNomvo($nomvo)
    {
        $this->nomvo = $nomvo;

        return $this;
    }

    /**
     * Get nomvo
     *
     * @return string
     */
    public function getNomvo()
    {
        return $this->nomvo;
    }

    /**
     * Set horaire
     *
     * @param string $horaire
     *
     * @return Article
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return string
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Article
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Article
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Article
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set acces
     *
     * @param string $acces
     *
     * @return Article
     */
    public function setAcces($acces)
    {
        $this->acces = $acces;

        return $this;
    }

    /**
     * Get acces
     *
     * @return string
     */
    public function getAcces()
    {
        return $this->acces;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Article
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Article
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add image
     *
     * @param \Champloo\ImageBundle\Entity\Image $image
     *
     * @return Article
     */
    public function addImage(\Champloo\ImageBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Champloo\ImageBundle\Entity\Image $image
     */
    public function removeImage(\Champloo\ImageBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
