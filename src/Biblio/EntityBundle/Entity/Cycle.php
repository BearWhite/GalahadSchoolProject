<?php

namespace Biblio\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cycle
 */
class Cycle
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $dureePret;

    /**
     * @var integer
     */
    private $nbLivre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $lecteurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lecteurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set dureePret
     *
     * @param \DateTime $dureePret
     * @return Cycle
     */
    public function setDureePret($dureePret)
    {
        $this->dureePret = $dureePret;

        return $this;
    }

    /**
     * Get dureePret
     *
     * @return \DateTime 
     */
    public function getDureePret()
    {
        return $this->dureePret;
    }

    /**
     * Set nbLivre
     *
     * @param integer $nbLivre
     * @return Cycle
     */
    public function setNbLivre($nbLivre)
    {
        $this->nbLivre = $nbLivre;

        return $this;
    }

    /**
     * Get nbLivre
     *
     * @return integer 
     */
    public function getNbLivre()
    {
        return $this->nbLivre;
    }

    /**
     * Add lecteurs
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteurs
     * @return Cycle
     */
    public function addLecteur(\Biblio\EntityBundle\Entity\Lecteur $lecteurs)
    {
        $this->lecteurs[] = $lecteurs;

        return $this;
    }

    /**
     * Remove lecteurs
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteurs
     */
    public function removeLecteur(\Biblio\EntityBundle\Entity\Lecteur $lecteurs)
    {
        $this->lecteurs->removeElement($lecteurs);
    }

    /**
     * Get lecteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLecteurs()
    {
        return $this->lecteurs;
    }
    
    public function __toString()
    {
        return "".$this->id;
    }
}
