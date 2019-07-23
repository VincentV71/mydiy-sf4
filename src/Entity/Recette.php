<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette", indexes={@ORM\Index(name="FK_UTILISER", columns={"id_base"}), @ORM\Index(name="FK_CUISINER", columns={"id_member"})})
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 */
class Recette
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRecet;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dat_recet", type="date", nullable=true)
     */
    private $datRecet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="qte_aro", type="decimal", precision=4, scale=1, nullable=true)
     */
    private $qteAro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="qte_bas", type="decimal", precision=4, scale=1, nullable=true)
     */
    private $qteBas;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_tot", type="integer", nullable=false)
     */
    private $qteTot;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dat_stee", type="date", nullable=true)
     */
    private $datStee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="eta_stee", type="string", length=5, nullable=true, options={"fixed"=true})
     */
    private $etaStee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="com_member", type="text", length=0, nullable=true)
     */
    private $comMember;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aff_recet", type="string", length=3, nullable=true, options={"fixed"=true})
     */
    private $affRecet;

    /**
     * @var int
     *
     * @ORM\Column(name="etoiles", type="integer", nullable=false)
     */
    private $etoiles;

    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_member", referencedColumnName="id_member")
     * })
     */
    private $idMember;

    /**
     * @var \Base
     *
     * @ORM\ManyToOne(targetEntity="Base")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_base", referencedColumnName="id_base")
     * })
     */
    private $idBase;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AromeRecette", mappedBy="idRecet", orphanRemoval=true)
     */
    private $aromeRecettes;

    public function __construct()
    {
        $this->aromeRecettes = new ArrayCollection();
    }

    public function getIdRecet(): ?int
    {
        return $this->idRecet;
    }

    public function getDatRecet(): ?\DateTimeInterface
    {
        return $this->datRecet;
    }

    public function setDatRecet(?\DateTimeInterface $datRecet): self
    {
        $this->datRecet = $datRecet;

        return $this;
    }

    public function getQteAro()
    {
        return $this->qteAro;
    }

    public function setQteAro($qteAro): self
    {
        $this->qteAro = $qteAro;

        return $this;
    }

    public function getQteBas()
    {
        return $this->qteBas;
    }

    public function setQteBas($qteBas): self
    {
        $this->qteBas = $qteBas;

        return $this;
    }

    public function getQteTot(): ?int
    {
        return $this->qteTot;
    }

    public function setQteTot(int $qteTot): self
    {
        $this->qteTot = $qteTot;

        return $this;
    }

    public function getDatStee(): ?\DateTimeInterface
    {
        return $this->datStee;
    }

    public function setDatStee(?\DateTimeInterface $datStee): self
    {
        $this->datStee = $datStee;

        return $this;
    }

    public function getEtaStee(): ?string
    {
        return $this->etaStee;
    }

    public function setEtaStee(?string $etaStee): self
    {
        $this->etaStee = $etaStee;

        return $this;
    }

    public function getComMember(): ?string
    {
        return $this->comMember;
    }

    public function setComMember(?string $comMember): self
    {
        $this->comMember = $comMember;

        return $this;
    }

    public function getAffRecet(): ?string
    {
        return $this->affRecet;
    }

    public function setAffRecet(?string $affRecet): self
    {
        $this->affRecet = $affRecet;

        return $this;
    }

    public function getEtoiles(): ?int
    {
        return $this->etoiles;
    }

    public function setEtoiles(int $etoiles): self
    {
        $this->etoiles = $etoiles;

        return $this;
    }

    public function getIdMember(): ?Member
    {
        return $this->idMember;
    }

    public function setIdMember(?Member $idMember): self
    {
        $this->idMember = $idMember;

        return $this;
    }

    public function getIdBase(): ?Base
    {
        return $this->idBase;
    }

    public function setIdBase(?Base $idBase): self
    {
        $this->idBase = $idBase;

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
            $aromeRecette->setIdRecet($this);
        }

        return $this;
    }

    public function removeAromeRecette(AromeRecette $aromeRecette): self
    {
        if ($this->aromeRecettes->contains($aromeRecette)) {
            $this->aromeRecettes->removeElement($aromeRecette);
            // set the owning side to null (unless already changed)
            if ($aromeRecette->getIdRecet() === $this) {
                $aromeRecette->setIdRecet(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->idRecet);
    }
}
