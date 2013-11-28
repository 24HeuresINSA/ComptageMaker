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
    private $briefing;

    /**
     * @var boolean
     * ouvert true, fermé false
     */
    private $etat;

    /**
     * @var \ComptageMaker\ComptageBundle\Entity\Session
     */
    private $sessions;

    /**
     * @var \DateTime
     */
    private $date;


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
     * Set etat
     *
     * @param boolean $etat
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
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add sessions
     *
     * @param \ComptageMaker\ComptageBundle\Entity\Session $sessions
     * @return Comptage
     */
    public function addSession(\ComptageMaker\ComptageBundle\Entity\Session $sessions)
    {
        $this->sessions[] = $sessions;
    
        return $this;
    }

    /**
     * Remove sessions
     *
     * @param \ComptageMaker\ComptageBundle\Entity\Session $sessions
     */
    public function removeSession(\ComptageMaker\ComptageBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Comptage
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}