<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface; 

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreUsuario = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var Collection<int, Personaje>
     */
    #[ORM\OneToMany(targetEntity: Personaje::class, mappedBy: 'usuario')]
    private Collection $personajes;

    #[ORM\OneToOne(mappedBy: 'usuario', cascade: ['persist', 'remove'])]
    private ?Jugadores $jugadores = null;

    public function __construct()
    {
        $this->personajes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): static
    {
        $this->nombreUsuario = $nombreUsuario;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->nombreUsuario;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // Garantizamos que todos los usuarios tengan al menos el ROLE_USER de jugador
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection<int, Personaje>
     */
    public function getPersonajes(): Collection
    {
        return $this->personajes;
    }

    public function addPersonaje(Personaje $personaje): static
    {
        if (!$this->personajes->contains($personaje)) {
            $this->personajes->add($personaje);
            $personaje->setUsuario($this);
        }

        return $this;
    }

    public function removePersonaje(Personaje $personaje): static
    {
        if ($this->personajes->removeElement($personaje)) {
            // set the owning side to null (unless already changed)
            if ($personaje->getUsuario() === $this) {
                $personaje->setUsuario(null);
            }
        }

        return $this;
    }

    public function getJugadores(): ?Jugadores
    {
        return $this->jugadores;
    }

    public function setJugadores(?Jugadores $jugadores): static
    {
        // unset the owning side of the relation if necessary
        if ($jugadores === null && $this->jugadores !== null) {
            $this->jugadores->setUsuario(null);
        }

        // set the owning side of the relation if necessary
        if ($jugadores !== null && $jugadores->getUsuario() !== $this) {
            $jugadores->setUsuario($this);
        }

        $this->jugadores = $jugadores;

        return $this;
    }
}