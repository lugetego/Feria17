<?php

namespace RegistroBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\GroupSequenceProviderInterface;


/**
 * Registro
 *
 * @ORM\Table(name="registro")
 * @ORM\Entity(repositoryClass="RegistroBundle\Repository\RegistroRepository")
 * @UniqueEntity("mail")
 * @ORM\HasLifecycleCallbacks
 */
class Registro
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
     * @ORM\Column(name="paterno", type="string", length=255)
     * @Assert\NotBlank(groups={"Registro"})
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", length=255)
     * @Assert\NotBlank(groups={"Registro"})
     */
    private $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(groups={"Registro"})
     */
    private $nombre;


    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255)
     */
    private $institucion;

    /**
     *
     * @ORM\Column(name="actividadm", type="array", length=1000, nullable=true)
     */
    protected $actividadm;

    /**
     *
     * @ORM\Column(name="actividadv", type="array", length=1000, nullable=true)
     */
    protected $actividadv;

    /**
     * @var string
     *
     * @ORM\Column(name="carrera", type="string", length=255)
     */
    private $carrera;

    /**
     * @var bool
     *
     * @ORM\Column(name="comida", type="boolean", nullable=true, length=255)
     */
    private $comida;

    /**
     * @var bool
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=true, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="playera", type="string", length=10,  nullable=true)
     */
    private $playera;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;


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
     * Set paterno
     *
     * @param string $paterno
     * @return Registro
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get paterno
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set materno
     *
     * @param string $materno
     * @return Registro
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get materno
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Registro
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Registro
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
     * Set institucion
     *
     * @param string $institucion
     * @return Registro
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set carrera
     *
     * @param string $carrera
     * @return Registro
     */
    public function setCarrera($carrera)
    {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return string
     */
    public function getCarrera()
    {
        return $this->carrera;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreated(new \DateTime());
        $this->setModified(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModified(new \DateTime());
    }

    /**
     * @return mixed
     */
    public function getActividadv()
    {
        return $this->actividadv;
    }

    /**
     * @param mixed $actividadv
     */
    public function setActividadv($actividadv)
    {
        $this->actividadv = $actividadv;
    }

    /**
     * @return mixed
     */
    public function getActividadm()
    {
        return $this->actividadm;
    }

    /**
     * @param mixed $actividadm
     */
    public function setActividadm($actividadm)
    {
        $this->actividadm = $actividadm;
    }

    /**
     * Set comida
     *
     * @param boolean $comida
     * @return Registro
     */
    public function setComida($comida)
    {
        $this->comida = $comida;

        return $this;
    }

    /**
     * Get comida
     *
     * @return boolean
     */
    public function getComida()
    {
        return $this->comida;
    }

    /**
     * @return boolean
     */
    public function isSexo()
    {
        return $this->sexo;
    }

    /**
     * @param boolean $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return string
     */
    public function getPlayera()
    {
        return $this->playera;
    }

    /**
     * @param string $playera
     */
    public function setPlayera($playera)
    {
        $this->playera = $playera;
    }

    /**
     * @Assert\IsTrue(message = "Es necesario que selecciones hasta 2 actividades, una  por cada horario"))
     */
    public function isActividadValid()

    {

        $summ = $sumv = 0;

        foreach ($this->actividadm as $actividad) {
            $summ += $actividad;
        }
        foreach ($this->actividadv as $actividad) {
            $sumv += $actividad;
        }

        $sum = $summ + $sumv;

        if (($sum >= 0 && $sum <= 2) && ($summ <= 1 && $sumv <= 1)) {
            return true;
        } else
            return false;

    }

}