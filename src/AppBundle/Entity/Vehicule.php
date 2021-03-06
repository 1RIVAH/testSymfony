<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voyageur
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_Place", type="integer")
     */
    private $nombrePlace;

    /**
     * @var bool
     *
     * @ORM\Column(name="disponibilite", type="boolean")
     */
    private $disponibilite=true;

    /**
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Voyageur")
     * @ORM\JoinColumn(name="user_id", nullable=true, referencedColumnName="id", onDelete="SET NULL")
     */
    private $voyageur;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Vehicule
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Vehicule
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
     * Set nombrePlace
     *
     * @param integer $nombrePlace
     *
     * @return Vehicule
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace = $nombrePlace;

        return $this;
    }

    /**
     * Get nombrePlace
     *
     * @return int
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace;
    }

    /**
     * Set disponibilite
     *
     * @param boolean $disponibilite
     *
     * @return Vehicule
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return boolean
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * Set voyageur
     *
     * @param AppBundle\Entity\Voyageur $voyageur
     *
     * @return Vehicule
     */
    public function setVoyageur(AppBundle\Entity\Voyageur $voyageur = null)
    {
        $this->voyageur = $voyageur;

        return $this;
    }

    /**
     * Get voyageur
     *
     * @return \Test\TestBundle\Entity\Voyageur
     */
    public function getVoyageur()
    {
        return $this->voyageur;
    }
}
