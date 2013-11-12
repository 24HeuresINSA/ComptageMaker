<?php

namespace ComptageMaker\ComptageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comptage
 */
class Comptage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $debut;

    /**
     * @var \DateTime
     */
    private $fin;

    /**
     * @var \DateTime
     */
    private $briefing;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $prix;

    /**
     * @var string
     */
    private $etat;


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
     * Set debut
     *
     * @param \DateTime $debut
     * @return Comptage
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    
        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Comptage
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    
        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set briefing
     *
     * @param \DateTime $briefing
     * @return Comptage
     */
    public function setBriefing($briefing)
    {
        $this->briefing = $briefing;
    
        return $this;
    }

    /**
     * Get briefing
     *
     * @return \DateTime 
     */
    public function getBriefing()
    {
        return $this->briefing;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Comptage
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Comptage
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Comptage
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
