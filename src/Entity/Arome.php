<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Arome
 *
 * @ORM\Table(name="arome")
 * @ORM\Entity(repositoryClass="App\Repository\AromeRepository")
 */
class Arome
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_aro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAro;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_aro", type="string", length=25, nullable=false, options={"fixed"=true})
     */
    private $nomAro;

    /**
     * @var string
     *
     * @ORM\Column(name="fab_aro", type="string", length=35, nullable=false, options={"fixed"=true})
     */
    private $fabAro;

    /**
     * @var int
     *
     * @ORM\Column(name="dos_fab", type="integer", nullable=false)
     */
    private $dosFab;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_j_stee", type="integer", nullable=false)
     */
    private $nbJStee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cat_aro", type="string", length=40, nullable=true, options={"fixed"=true})
     */
    private $catAro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aff_aro", type="string", length=3, nullable=true, options={"fixed"=true})
     */
    private $affAro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AromeRecette", mappedBy="idAro", orphanRemoval=true)
     */
    private $aromeRecettes;

    public function __construct()
    {
        $this->aromeRecettes = new ArrayCollection();
    }

    public function getIdAro(): ?int
    {
        return $this->idAro;
    }

    public function getNomAro(): ?string
    {
        return $this->nomAro;
    }

    public function setNomAro(string $nomAro): self
    {
        $this->nomAro = $nomAro;

        return $this;
    }

    public function getFabAro(): ?string
    {
        return $this->fabAro;
    }

    public function setFabAro(string $fabAro): self
    {
        $this->fabAro = $fabAro;

        return $this;
    }

    public function getDosFab(): ?int
    {
        return $this->dosFab;
    }

    public function setDosFab(int $dosFab): self
    {
        $this->dosFab = $dosFab;

        return $this;
    }

    public function getNbJStee(): ?int
    {
        return $this->nbJStee;
    }

    public function setNbJStee(int $nbJStee): self
    {
        $this->nbJStee = $nbJStee;

        return $this;
    }

    public function getCatAro(): ?string
    {
        return $this->catAro;
    }

    public function setCatAro(?string $catAro): self
    {
        $this->catAro = $catAro;

        return $this;
    }

    public function getAffAro(): ?string
    {
        return $this->affAro;
    }

    public function setAffAro(?string $affAro): self
    {
        $this->affAro = $affAro;

        return $this;
    }

    /**
     * @return Collection|AromeRecette[]
     */
    public function getAromeRecettes(): Collection
    {
        return $this->aromeRecettes;
    }

    public function addAromeRecette(AromeRecette $aromeRecette): self
    {
        if (!$this->aromeRecettes->contains($aromeRecette)) {
            $this->aromeRecettes[] = $aromeRecette;
            $aromeRecette->setIdAro($this);
        }

        return $this;
    }

    public function removeAromeRecette(AromeRecette $aromeRecette): self
    {
        if ($this->aromeRecettes->contains($aromeRecette)) {
            $this->aromeRecettes->removeElement($aromeRecette);
            // set the owning side to null (unless already changed)
            if ($aromeRecette->getIdAro() === $this) {
                $aromeRecette->setIdAro(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->idAro);
    }

}
