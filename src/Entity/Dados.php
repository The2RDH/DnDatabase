<?php

namespace App\Entity;

use App\Repository\DadosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DadosRepository::class)]
class Dados
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, DadosDescanso>
     */
    #[ORM\OneToMany(targetEntity: DadosDescanso::class, mappedBy: 'dados')]
    private Collection $dadosDescansos;

    public function __construct()
    {
        $this->dadosDescansos = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, DadosDescanso>
     */
    public function getDadosDescansos(): Collection
    {
        return $this->dadosDescansos;
    }

    public function addDadosDescanso(DadosDescanso $dadosDescanso): static
    {
        if (!$this->dadosDescansos->contains($dadosDescanso)) {
            $this->dadosDescansos->add($dadosDescanso);
            $dadosDescanso->setDados($this);
        }

        return $this;
    }

    public function removeDadosDescanso(DadosDescanso $dadosDescanso): static
    {
        if ($this->dadosDescansos->removeElement($dadosDescanso)) {
            // set the owning side to null (unless already changed)
            if ($dadosDescanso->getDados() === $this) {
                $dadosDescanso->setDados(null);
            }
        }

        return $this;
    }
}
