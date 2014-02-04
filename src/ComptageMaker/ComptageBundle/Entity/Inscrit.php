<?php

namespace ComptageMaker\ComptageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Inscrit
 */
class Inscrit
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
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var \ComptageMaker\ComptageBundle\Entity\Association
     */
    private $association;

    /**
     * @var boolean
     */
    private $voiture;

    /**
     * @var string
     */
    private $commentaires = null;


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
     * @return Inscrit
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
     * @return Inscrit
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
     * Set mail
     *
     * @param string $mail
     * @return Inscrit
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Inscrit
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set voiture
     *
     * @param boolean $voiture
     * @return Inscrit
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;
    
        return $this;
    }

    /**
     * Get voiture
     *
     * @return boolean 
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return Inscrit
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set association
     *
     * @param \ComptageMaker\ComptageBundle\Entity\Association $association
     * @return Inscrit
     */
    public function setAssociation(\ComptageMaker\ComptageBundle\Entity\Association $association = null)
    {
        $this->association = $association;
    
        return $this;
    }

    /**
     * Get association
     *
     * @return \ComptageMaker\ComptageBundle\Entity\Association 
     */
    public function getAssociation()
    {
        return $this->association;
    }
}