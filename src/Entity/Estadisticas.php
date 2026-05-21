<?php

namespace App\Entity;

use App\Repository\EstadisticasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadisticasRepository::class)]
class Estadisticas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $fuerza = null;

    #[ORM\Column(nullable: true)]
    private ?int $destreza = null;

    #[ORM\Column(nullable: true)]
    private ?int $intelecto = null;

    #[ORM\Column(nullable: true)]
    private ?int $constitucion = null;

    #[ORM\Column(nullable: true)]
    private ?int $sabiduria = null;

    #[ORM\Column(nullable: true)]
    private ?int $carisma = null;

    #[ORM\Column(nullable: true)]
    private ?int $acrobacias = null;

    #[ORM\Column(nullable: true)]
    private ?int $animalismo = null;

    #[ORM\Column(nullable: true)]
    private ?int $atletismo = null;

    #[ORM\Column(nullable: true)]
    private ?int $caos = null;

    #[ORM\Column(nullable: true)]
    private ?int $conocimientoMagico = null;

    #[ORM\Column(nullable: true)]
    private ?int $enganio = null;

    #[ORM\Column(nullable: true)]
    private ?int $religion = null;

    #[ORM\Column(nullable: true)]
    private ?int $historia = null;

    #[ORM\Column(nullable: true)]
    private ?int $interpretacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $intimidacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $investigacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $juegoManos = null;

    #[ORM\Column(nullable: true)]
    private ?int $medicina = null;

    #[ORM\Column(nullable: true)]
    private ?int $naturaleza = null;

    #[ORM\Column(nullable: true)]
    private ?int $orden = null;

    #[ORM\Column(nullable: true)]
    private ?int $percepcion = null;

    #[ORM\Column(nullable: true)]
    private ?int $perspicacia = null;

    #[ORM\Column(nullable: true)]
    private ?int $persuasion = null;

    #[ORM\Column(nullable: true)]
    private ?int $sigilo = null;

    #[ORM\Column(nullable: true)]
    private ?int $supervivencia = null;

    #[ORM\Column(nullable: true)]
    private ?int $vida = null;

    #[ORM\ManyToOne(inversedBy: 'estadisticas')]
    private ?Recursos $recurso = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidadRecurso = null;

    #[ORM\Column(nullable: true)]
    private ?int $movimiento = null;

    #[ORM\Column(nullable: true)]
    private ?int $armadura = null;

    #[ORM\Column(nullable: true)]
    private ?int $iniciativa = null;

    #[ORM\ManyToOne(inversedBy: 'estadisticas')]
    private ?Recursos $recursoSecundario = null;

    #[ORM\Column(nullable: true)]
    private ?int $cantidadRecursoSecundario = null;

    #[ORM\Column(nullable: true)]
    private ?int $competencia = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuerza(): ?int
    {
        return $this->fuerza;
    }

    public function setFuerza(?int $fuerza): static
    {
        $this->fuerza = $fuerza;

        return $this;
    }

    public function getDestreza(): ?int
    {
        return $this->destreza;
    }

    public function setDestreza(?int $destreza): static
    {
        $this->destreza = $destreza;

        return $this;
    }

    public function getIntelecto(): ?int
    {
        return $this->intelecto;
    }

    public function setIntelecto(?int $intelecto): static
    {
        $this->intelecto = $intelecto;

        return $this;
    }

    public function getConstitucion(): ?int
    {
        return $this->constitucion;
    }

    public function setConstitucion(?int $constitucion): static
    {
        $this->constitucion = $constitucion;

        return $this;
    }

    public function getSabiduria(): ?int
    {
        return $this->sabiduria;
    }

    public function setSabiduria(?int $sabiduria): static
    {
        $this->sabiduria = $sabiduria;

        return $this;
    }

    public function getCarisma(): ?int
    {
        return $this->carisma;
    }

    public function setCarisma(?int $carisma): static
    {
        $this->carisma = $carisma;

        return $this;
    }

    public function getAcrobacias(): ?int
    {
        return $this->acrobacias;
    }

    public function setAcrobacias(?int $acrobacias): static
    {
        $this->acrobacias = $acrobacias;

        return $this;
    }

    public function getAnimalismo(): ?int
    {
        return $this->animalismo;
    }

    public function setAnimalismo(?int $animalismo): static
    {
        $this->animalismo = $animalismo;

        return $this;
    }

    public function getAtletismo(): ?int
    {
        return $this->atletismo;
    }

    public function setAtletismo(?int $atletismo): static
    {
        $this->atletismo = $atletismo;

        return $this;
    }

    public function getCaos(): ?int
    {
        return $this->caos;
    }

    public function setCaos(?int $caos): static
    {
        $this->caos = $caos;

        return $this;
    }

    public function getConocimientoMagico(): ?int
    {
        return $this->conocimientoMagico;
    }

    public function setConocimientoMagico(?int $conocimientoMagico): static
    {
        $this->conocimientoMagico = $conocimientoMagico;

        return $this;
    }

    public function getEnganio(): ?int
    {
        return $this->enganio;
    }

    public function setEnganio(?int $enganio): static
    {
        $this->enganio = $enganio;

        return $this;
    }

    public function getReligion(): ?int
    {
        return $this->religion;
    }

    public function setReligion(?int $religion): static
    {
        $this->religion = $religion;

        return $this;
    }

    public function getHistoria(): ?int
    {
        return $this->historia;
    }

    public function setHistoria(?int $historia): static
    {
        $this->historia = $historia;

        return $this;
    }

    public function getInterpretacion(): ?int
    {
        return $this->interpretacion;
    }

    public function setInterpretacion(?int $interpretacion): static
    {
        $this->interpretacion = $interpretacion;

        return $this;
    }

    public function getIntimidacion(): ?int
    {
        return $this->intimidacion;
    }

    public function setIntimidacion(?int $intimidacion): static
    {
        $this->intimidacion = $intimidacion;

        return $this;
    }

    public function getInvestigacion(): ?int
    {
        return $this->investigacion;
    }

    public function setInvestigacion(?int $investigacion): static
    {
        $this->investigacion = $investigacion;

        return $this;
    }

    public function getJuegoManos(): ?int
    {
        return $this->juegoManos;
    }

    public function setJuegoManos(?int $juegoManos): static
    {
        $this->juegoManos = $juegoManos;

        return $this;
    }

    public function getMedicina(): ?int
    {
        return $this->medicina;
    }

    public function setMedicina(?int $medicina): static
    {
        $this->medicina = $medicina;

        return $this;
    }

    public function getNaturaleza(): ?int
    {
        return $this->naturaleza;
    }

    public function setNaturaleza(?int $naturaleza): static
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    public function getPercepcion(): ?int
    {
        return $this->percepcion;
    }

    public function setPercepcion(?int $percepcion): static
    {
        $this->percepcion = $percepcion;

        return $this;
    }

    public function getPerspicacia(): ?int
    {
        return $this->perspicacia;
    }

    public function setPerspicacia(?int $perspicacia): static
    {
        $this->perspicacia = $perspicacia;

        return $this;
    }

    public function getPersuasion(): ?int
    {
        return $this->persuasion;
    }

    public function setPersuasion(?int $persuasion): static
    {
        $this->persuasion = $persuasion;

        return $this;
    }

    public function getSigilo(): ?int
    {
        return $this->sigilo;
    }

    public function setSigilo(?int $sigilo): static
    {
        $this->sigilo = $sigilo;

        return $this;
    }

    public function getSupervivencia(): ?int
    {
        return $this->supervivencia;
    }

    public function setSupervivencia(?int $supervivencia): static
    {
        $this->supervivencia = $supervivencia;

        return $this;
    }

    public function getVida(): ?int
    {
        return $this->vida;
    }

    public function setVida(?int $vida): static
    {
        $this->vida = $vida;

        return $this;
    }

    public function getRecurso(): ?Recursos
    {
        return $this->recurso;
    }

    public function setRecurso(?Recursos $recurso): static
    {
        $this->recurso = $recurso;

        return $this;
    }

    public function getCantidadRecurso(): ?int
    {
        return $this->cantidadRecurso;
    }

    public function setCantidadRecurso(?int $cantidadRecurso): static
    {
        $this->cantidadRecurso = $cantidadRecurso;

        return $this;
    }

    public function getMovimiento(): ?int
    {
        return $this->movimiento;
    }

    public function setMovimiento(?int $movimiento): static
    {
        $this->movimiento = $movimiento;

        return $this;
    }

    public function getArmadura(): ?int
    {
        return $this->armadura;
    }

    public function setArmadura(?int $armadura): static
    {
        $this->armadura = $armadura;

        return $this;
    }

    public function getIniciativa(): ?int
    {
        return $this->iniciativa;
    }

    public function setIniciativa(?int $iniciativa): static
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function getRecursoSecundario(): ?Recursos
    {
        return $this->recursoSecundario;
    }

    public function setRecursoSecundario(?Recursos $recursoSecundario): static
    {
        $this->recursoSecundario = $recursoSecundario;

        return $this;
    }

    public function getCantidadRecursoSecundario(): ?int
    {
        return $this->cantidadRecursoSecundario;
    }

    public function setCantidadRecursoSecundario(?int $cantidadRecursoSecundario): static
    {
        $this->cantidadRecursoSecundario = $cantidadRecursoSecundario;

        return $this;
    }

    public function getCompetencia(): ?int
    {
        return $this->competencia;
    }

    public function setCompetencia(?int $competencia): static
    {
        $this->competencia = $competencia;

        return $this;
    }
}
