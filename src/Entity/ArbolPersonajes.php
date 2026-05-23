<?php

namespace App\Entity;

use App\Repository\ArbolPersonajesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArbolPersonajesRepository::class)]
class ArbolPersonajes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $padre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $madre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $hermanos = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $hijos = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $apellido = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $emblema = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lugarNacimiento = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $residencia = null;

    #[ORM\OneToOne(inversedBy: 'arbolPersonajes', cascade: ['persist', 'remove'])]
    private ?Personaje $personaje = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPadre(): ?string
    {
        return $this->padre;
    }

    public function setPadre(?string $padre): static
    {
        $this->padre = $padre;

        return $this;
    }

    public function getMadre(): ?string
    {
        return $this->madre;
    }

    public function setMadre(?string $madre): static
    {
        $this->madre = $madre;

        return $this;
    }

    public function getHermanos(): ?string
    {
        return $this->hermanos;
    }

    public function setHermanos(?string $hermanos): static
    {
        $this->hermanos = $hermanos;

        return $this;
    }

    public function getHijos(): ?string
    {
        return $this->hijos;
    }

    public function setHijos(?string $hijos): static
    {
        $this->hijos = $hijos;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEmblema(): ?string
    {
        return $this->emblema;
    }

    public function setEmblema(?string $emblema): static
    {
        $this->emblema = $emblema;

        return $this;
    }

    public function getLugarNacimiento(): ?string
    {
        return $this->lugarNacimiento;
    }

    public function setLugarNacimiento(?string $lugarNacimiento): static
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    public function getResidencia(): ?string
    {
        return $this->residencia;
    }

    public function setResidencia(?string $residencia): static
    {
        $this->residencia = $residencia;

        return $this;
    }

    public function getPersonaje(): ?Personaje
    {
        return $this->personaje;
    }

    public function setPersonaje(?Personaje $personaje): static
    {
        $this->personaje = $personaje;

        return $this;
    }
}
