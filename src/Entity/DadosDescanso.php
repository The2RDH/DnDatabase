<?php

namespace App\Entity;

use App\Repository\DadosDescansoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DadosDescansoRepository::class)]
class DadosDescanso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Especializacion>
     */
    #[ORM\OneToMany(targetEntity: Especializacion::class, mappedBy: 'dadosDescanso')]
    private Collection $especializaciÃon;

    #[ORM\ManyToOne(inversedBy: 'dadosDescansos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dados $dados = null;

    public function __construct()
    {
        $this->especializaciÃon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Especializacion>
     */
    public function getEspecializaciÃon(): Collection
    {
        return $this->especializaciÃon;
    }

    public function addEspecializaciOn(Especializacion $especializaciOn): static
    {
        if (!$this->especializaciÃon->contains($especializaciOn)) {
            $this->especializaciÃon->add($especializaciOn);
            $especializaciOn->setDadosDescanso($this);
        }

        return $this;
    }

    public function removeEspecializaciOn(Especializacion $especializaciOn): static
    {
        if ($this->especializaciÃon->removeElement($especializaciOn)) {
            // set the owning side to null (unless already changed)
            if ($especializaciOn->getDadosDescanso() === $this) {
                $especializaciOn->setDadosDescanso(null);
            }
        }

        return $this;
    }

    public function getDados(): ?Dados
    {
        return $this->dados;
    }

    public function setDados(?Dados $dados): static
    {
        $this->dados = $dados;

        return $this;
    }
}
