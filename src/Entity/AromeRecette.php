<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AromeRecette
 *
 * @ORM\Table(name="arome_recette")
 * @ORM\Entity(repositoryClass="App\Repository\AromeRecetteRepository")
 */
class AromeRecette
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_arome_recette", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recette", inversedBy="aromeRecettes", cascade={"all"})
     * @ORM\JoinColumn(nullable=false,referencedColumnName="id_recet")
     */
    private $idRecet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arome", inversedBy="aromeRecettes")
     * @ORM\JoinColumn(nullable=false,referencedColumnName="id_aro")
     */
    private $idAro;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $dosAro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRecet(): ?Recette
    {
        return $this->idRecet;
    }

    public function setIdRecet(?Recette $idRecet): self
    {
        $this->idRecet = $idRecet;

        return $this;
    }

    public function getIdAro(): ?Arome
    {
        return $this->idAro;
    }

    public function setIdAro(?Arome $idAro): self
    {
        $this->idAro = $idAro;

        return $this;
    }

    public function getDosAro()
    {
        return $this->dosAro;
    }

    public function setDosAro($dosAro): self
    {
        $this->dosAro = $dosAro;

        return $this;
    }
}
