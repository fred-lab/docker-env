<?php

namespace Champloo\TaxonomieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smartlink
 *
 * @ORM\Table(name="Taxonomie_Smartlink")
 * @ORM\Entity(repositoryClass="Champloo\TaxonomieBundle\Entity\SmartlinkRepository")
 */
class Smartlink
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
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    // *
    //  * Entité propriétaire
    //  * @ORM\OneToOne(targetEntity="Champloo\TaxonomieBundle\Entity\Terme", inversedBy="smartlink", cascade={"persist"})
    //  * @ORM\JoinColumn(name="terme_id", referencedColumnName="id", onDelete="CASCADE")
     
    // private $terme;


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
     * Set lien
     *
     * @param string $lien
     *
     * @return Smartlink
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
     * Set terme
     *
     * @param \Champloo\TaxonomieBundle\Entity\Terme $terme
     *
     * @return Smartlink
     */
    public function setTerme(\Champloo\TaxonomieBundle\Entity\Terme $terme = null)
    {
        $this->terme = $terme;

        return $this;
    }

    /**
     * Get terme
     *
     * @return \Champloo\TaxonomieBundle\Entity\Terme
     */
    public function getTerme()
    {
        return $this->terme;
    }
}
