<?php

namespace ComptageMaker\ComptageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entries
 */
class Entries
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $valeur;

    /**
     * @ORM\OneToOne(targetEntity="Plage")
     */
    protected $plage;


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
     * @return Entries
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
     * Set valeur
     *
     * @param integer $valeur
     * @return Entries
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return integer 
     */
    public function getValeur()
    {   
        return $this->valeur;
    }
}
