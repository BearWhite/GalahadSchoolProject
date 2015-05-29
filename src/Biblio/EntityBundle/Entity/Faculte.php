<?php

namespace Biblio\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faculte
 */
class Faculte
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
     * Set nom
     *
     * @param string $nom
     * @return Faculte
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
     * Add lecteurs
     *
     * @param \Biblio\EntityBundle\Entity\Lecteur $lecteurs
     * @return Faculte
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
        return $this->nom;
    }
}
