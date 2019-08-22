<?php

namespace AppBundle\Entity;


use AppBundle\Util\Slugger;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Ciudad
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Ciudad
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $nombre;

    /** @ORM\Column(type="string", length=100) */
    protected $slug;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->slug = Slugger::getSlug($nombre);
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}