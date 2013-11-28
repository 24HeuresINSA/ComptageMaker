<?php

namespace ComptageMaker\ComptageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 */
class Session
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $entries;

    /**
     * @ORM\OneToOne(targetEntity="Plage")
     */
    protected $plage;

    /**
     * @var string
     * vélos, motos, ...
     */
    private $type;

    /**
     * @var integer
     * rémunération en euros/heures
     */
    private $prix;

    /**
     * @var \ComptageMaker\ComptageBundle\Entity\Inscrit
     */
    private $inscrits;


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
     * Set plage
     *
     * @param string $plage
     * @return Session
     */
    public function setPlage($plage)
    {
        $this->plage = $plage;
    
        return $this;
    }

    /**
     * Get plage
     *
     * @return string 
     */
    public function getPlage()
    {
        return $this->plage;
    }

    /**
     * Set entries
     *
     * @param integer $entries
     * @return Session
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    
        return $this;
    }

    /**
     * Get entries
     *
     * @return integer 
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set inscrits
     *
     * @param \ComptageMaker\ComptageBundle\Entity\Inscrit $inscrits
     * @return Session
     */
    public function setInscrits(\ComptageMaker\ComptageBundle\Entity\Inscrit $inscrits = null)
    {
        $this->inscrits = $inscrits;
    
        return $this;
    }

    /**
     * Get inscrits
     *
     * @return \ComptageMaker\ComptageBundle\Entity\Inscrit 
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Session
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
     * @return Session
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
}