<?php

namespace Biblio\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lecteur
 */
class Lecteur
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var \Biblio\EntityBundle\Entity\Pret
     */
    private $pret;

    /**
     * @var \Biblio\EntityBundle\Entity\Cycle
     */
    private $cycle;

    /**
     * @var \Biblio\EntityBundle\Entity\Faculte
     */
    private $faculte;


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
     * @return Lecteur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Lecteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pret
     *
     * @param \Biblio\EntityBundle\Entity\Pret $pret
     * @return Lecteur
     */
    public function setPret(\Biblio\EntityBundle\Entity\Pret $pret = null)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return \Biblio\EntityBundle\Entity\Pret 
     */
    public function getPret()
    {
        return $this->pret;
    }

    /**
     * Set cycle
     *
     * @param \Biblio\EntityBundle\Entity\Cycle $cycle
     * @return Lecteur
     */
    public function setCycle(\Biblio\EntityBundle\Entity\Cycle $cycle = null)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get cycle
     *
     * @return \Biblio\EntityBundle\Entity\Cycle 
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set faculte
     *
     * @param \Biblio\EntityBundle\Entity\Faculte $faculte
     * @return Lecteur
     */
    public function setFaculte(\Biblio\EntityBundle\Entity\Faculte $faculte = null)
    {
        $this->faculte = $faculte;

        return $this;
    }

    /**
     * Get faculte
     *
     * @return \Biblio\EntityBundle\Entity\Faculte 
     */
    public function getFaculte()
    {
        return $this->faculte;
    }
    
    public function __toString()
    {
        return $this->prenom . " " .$this->nom;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prets
     *
     * @param \Biblio\EntityBundle\Entity\Pret $prets
     * @return Lecteur
     */
    public function addPret(\Biblio\EntityBundle\Entity\Pret $prets)
    {
        $this->prets[] = $prets;

        return $this;
    }

    /**
     * Remove prets
     *
     * @param \Biblio\EntityBundle\Entity\Pret $prets
     */
    public function removePret(\Biblio\EntityBundle\Entity\Pret $prets)
    {
        $this->prets->removeElement($prets);
    }

    /**
     * Get prets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrets()
    {
        return $this->prets;
    }
}
