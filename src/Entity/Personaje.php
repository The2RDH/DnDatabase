<?php

namespace App\Entity;

use App\Repository\PersonajeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonajeRepository::class)]
class Personaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Apellido = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $altura = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $peso = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $edad = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $originario = null;

    /**
     * @var Collection<int, Idiomas>
     */
    #[ORM\ManyToMany(targetEntity: Idiomas::class, inversedBy: 'personajes')]
    private Collection $idiomas;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Alineamiento $alineamiento = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Razas $raza = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Clases $clase = null;

    #[ORM\Column(nullable: true)]
    private ?int $nivel = null;

    #[ORM\ManyToOne(inversedBy: 'personajes')]
    private ?Jugadores $jugador = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\OneToOne(mappedBy: 'personaje', cascade: ['persist', 'remove'])]
    private ?ArbolPersonajes $arbolPersonajes = null;

    /**
     * @var Collection<int, Inventario>
     */
    #[ORM\OneToMany(targetEntity: Inventario::class, mappedBy: 'personaje')]
    private Collection $inventarios;

    #[ORM\OneToOne(inversedBy: 'personaje', cascade: ['persist', 'remove'])]
    private ?Estadisticas $estadisticas = null;

    public function __toString(): string
    {
        return $this->nombre ?? 'Personaje sin nombre';
    }

    public function __construct()
    {
        $this->idiomas = new ArrayCollection();
        $this->inventarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(?string $Apellido): static
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getAltura(): ?string
    {
        return $this->altura;
    }

    public function setAltura(?string $altura): static
    {
        $this->altura = $altura;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->edad;
    }

    public function setEdad(?string $edad): static
    {
        $this->edad = $edad;

        return $this;
    }

    public function getOriginario(): ?string
    {
        return $this->originario;
    }

    public function setOriginario(?string $originario): static
    {
        $this->originario = $originario;

        return $this;
    }

    /**
     * @return Collection<int, Idiomas>
     */
    public function getIdiomas(): Collection
    {
        return $this->idiomas;
    }

    public function addIdioma(Idiomas $idioma): static
    {
        if (!$this->idiomas->contains($idioma)) {
            $this->idiomas->add($idioma);
        }

        return $this;
    }

    public function removeIdioma(Idiomas $idioma): static
    {
        $this->idiomas->removeElement($idioma);

        return $this;
    }

    public function getAlineamiento(): ?Alineamiento
    {
        return $this->alineamiento;
    }

    public function setAlineamiento(?Alineamiento $alineamiento): static
    {
        $this->alineamiento = $alineamiento;

        return $this;
    }

    public function getRaza(): ?Razas
    {
        return $this->raza;
    }

    public function setRaza(?Razas $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getClase(): ?Clases
    {
        return $this->clase;
    }

    public function setClase(?Clases $clase): static
    {
        $this->clase = $clase;

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->nivel;
    }

    public function setNivel(?int $nivel): static
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getJugador(): ?Jugadores
    {
        return $this->jugador;
    }

    public function setJugador(?Jugadores $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getNombreCompleto(): string
    {
        return trim(($this->nombre ?? '') . ' ' . ($this->apellido ?? ''));
    }

    public function getArbolPersonajes(): ?ArbolPersonajes
    {
        return $this->arbolPersonajes;
    }

    public function setArbolPersonajes(?ArbolPersonajes $arbolPersonajes): static
    {
        // unset the owning side of the relation if necessary
        if ($arbolPersonajes === null && $this->arbolPersonajes !== null) {
            $this->arbolPersonajes->setPersonaje(null);
        }

        // set the owning side of the relation if necessary
        if ($arbolPersonajes !== null && $arbolPersonajes->getPersonaje() !== $this) {
            $arbolPersonajes->setPersonaje($this);
        }

        $this->arbolPersonajes = $arbolPersonajes;

        return $this;
    }

    /**
     * @return Collection<int, Inventario>
     */
    public function getInventarios(): Collection
    {
        return $this->inventarios;
    }

    public function addInventario(Inventario $inventario): static
    {
        if (!$this->inventarios->contains($inventario)) {
            $this->inventarios->add($inventario);
            $inventario->setPersonaje($this);
        }

        return $this;
    }

    public function removeInventario(Inventario $inventario): static
    {
        if ($this->inventarios->removeElement($inventario)) {
            // set the owning side to null (unless already changed)
            if ($inventario->getPersonaje() === $this) {
                $inventario->setPersonaje(null);
            }
        }

        return $this;
    }

    public function getEstadisticas(): ?Estadisticas
    {
        return $this->estadisticas;
    }

    public function setEstadisticas(?Estadisticas $estadisticas): static
    {
        $this->estadisticas = $estadisticas;

        return $this;
    }
}
