<?php

namespace Biblio\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pret
 */
class Pret
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateReservation;

    /**
     * @var \DateTime
     */
    private $dateRetourMax;

    /**
     * @var boolean
     */
    private $isReservation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $inscrit;

    /**
     * @var \Biblio\EntityBundle\Entity\Livre
     */
    private $livre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscrit = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     * @return Pret
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime 
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set dateRetourMax
     *
     * @param \DateTime $dateRetourMax
     * @return Pret
     */
    public function setDateRetourMax($dateRetourMax)
    {
        $this->dateRetourMax = $dateRetourMax;

        return $this;
    }

    /**
     * Get dateRetourMax
     *
     * @return \DateTime 
     */
    public function getDateRetourMax()
    {
        return $this->dateRetourMax;
    }

    /**
     * Set isReservation
     *
     * @param boolean $isReservation
     * @return Pret
     */
    public function setIsReservation($isReservation)
    {
        $this->isReservation = $isReservation;

        return $this;
    }

    /**
     * Get isReservation
     *
     * @return boolean 
     */
    public function getIsReservation()
    {
        return $this->isReservation;
    }

    /**
     * Add inscrit
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $inscrit
     * @return Pret
     */
    public function addInscrit(\Biblio\EntityBundle\Entity\Lecteur $inscrit)
    {
        $this->inscrit[] = $inscrit;

        return $this;
    }

    /**
     * Remove inscrit
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $inscrit
     */
    public function removeInscrit(\Biblio\EntityBundle\Entity\Lecteur $inscrit)
    {
        $this->inscrit->removeElement($inscrit);
    }

    /**
     * Get inscrit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }

    /**
     * Set livre
     *
     * @param \Biblio\EntityBundle\Entity\Livre $livre
     * @return Pret
     */
    public function setLivre(\Biblio\EntityBundle\Entity\Livre $livre = null)
    {
        $this->livre = $livre;

        return $this;
    }

    /**
     * Get livre
     *
     * @return \Biblio\EntityBundle\Entity\Livre 
     */
    public function getLivre()
    {
        return $this->livre;
    }
}
