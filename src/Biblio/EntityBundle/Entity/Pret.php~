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
     * @var boolean
     */
    private $isReservation;

    /**
     * @var \Biblio\EntityBundle\Entity\Livre
     */
    private $livre;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $date=new \DateTime();
        $this->dateReservation=$date;
        $this->lecteur = new \Doctrine\Common\Collections\ArrayCollection();
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $lecteur;


    /**
     * Add lecteur
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteur
     * @return Pret
     */
    public function addLecteur(\Biblio\EntityBundle\Entity\Lecteur $lecteur)
    {
        $this->lecteur[] = $lecteur;

        return $this;
    }

    /**
     * Remove lecteur
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteur
     */
    public function removeLecteur(\Biblio\EntityBundle\Entity\Lecteur $lecteur)
    {
        $this->lecteur->removeElement($lecteur);
    }

    /**
     * Get lecteur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLecteur()
    {
        return $this->lecteur;
    }

    /**
     * Set lecteur
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteur
     * @return Pret
     */
    public function setLecteur(\Biblio\EntityBundle\Entity\Lecteur $lecteur = null)
    {
        $this->lecteur = $lecteur;

        return $this;
    }
}
