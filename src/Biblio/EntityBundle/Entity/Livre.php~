<?php

namespace Biblio\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 */
class Livre
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $resume;

    /**
     * @var integer
     */
    private $nbExemplaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prets;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $themes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $auteurs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->auteurs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     * @return Livre
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
     * Set resume
     *
     * @param string $resume
     * @return Livre
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set nbExemplaire
     *
     * @param integer $nbExemplaire
     * @return Livre
     */
    public function setNbExemplaire($nbExemplaire)
    {
        $this->nbExemplaire = $nbExemplaire;

        return $this;
    }

    /**
     * Get nbExemplaire
     *
     * @return integer 
     */
    public function getNbExemplaire()
    {
        return $this->nbExemplaire;
    }

    /**
     * Add prets
     *
     * @param \Biblio\EntityBundle\Entity\Pret $prets
     * @return Livre
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

    /**
     * Add themes
     *
     * @param \Biblio\EntityBundle\Entity\Theme $themes
     * @return Livre
     */
    public function addTheme(\Biblio\EntityBundle\Entity\Theme $themes)
    {
        $this->themes[] = $themes;

        return $this;
    }

    /**
     * Remove themes
     *
     * @param \Biblio\EntityBundle\Entity\Theme $themes
     */
    public function removeTheme(\Biblio\EntityBundle\Entity\Theme $themes)
    {
        $this->themes->removeElement($themes);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Add auteurs
     *
     * @param \Biblio\EntityBundle\Entity\Auteur $auteurs
     * @return Livre
     */
    public function addAuteur(\Biblio\EntityBundle\Entity\Auteur $auteurs)
    {
        $this->auteurs[] = $auteurs;

        return $this;
    }

    /**
     * Remove auteurs
     *
     * @param \Biblio\EntityBundle\Entity\Auteur $auteurs
     */
    public function removeAuteur(\Biblio\EntityBundle\Entity\Auteur $auteurs)
    {
        $this->auteurs->removeElement($auteurs);
    }

    /**
     * Get auteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuteurs()
    {
        return $this->auteurs;
    }

        public function __toString(){
        return  $this->titre;
    }
}
