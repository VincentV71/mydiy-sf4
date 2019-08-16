<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as MyDiyAssert;

/**
 * Recette
 *
 * @ORM\Table(name="recette", indexes={@ORM\Index(name="FK_UTILISER", columns={"id_base"}), @ORM\Index(name="FK_CUISINER", columns={"id_member"})})
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 * @MyDiyAssert\RecetteTotal
 * @MyDiyAssert\RecetteSteep
 * @MyDiyAssert\RecetteArome
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
     * @var \DateTime
     *
     * @ORM\Column(name="dat_recet", type="date", nullable=false)
     */
    private $datRecet ;

    /**
     * @var string
     *
     * @ORM\Column(name="qte_aro", type="decimal", precision=4, scale=1, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]{0,3}((\.\d)?|(\,\d)?)$/",
     *    message="Entrez un nombre entier ou à une décimale, entre 0.1 et 500")
     * @Assert\Range(
     *    min = 0.1,
     *    max = 500,
     *    minMessage = "La valeur minimum est de 0.1 ml",
     *    maxMessage = "La valeur maximum est de 500 ml",
     *    invalidMessage = "Entrez un nombre entier ou à une décimale, entre 0.1 et 500",
     *  )
     */
    private $qteAro;

    /**
     * @var string
     *
     * @ORM\Column(name="qte_bas", type="decimal", precision=4, scale=1, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]{0,3}((\.\d)?|(\,\d)?)$/",
     *    message="Entrez un nombre entier ou à une décimale, entre 2.5 et 990")
     * @Assert\Range(
     *    min = 2.5,
     *    max = 990,
     *    minMessage = "La valeur minimum est de 2.5 ml",
     *    maxMessage = "La valeur maximum est de 990 ml",
     *    invalidMessage = "Entrez un nombre entier ou à une décimale, entre 2.5 et 990",
     *  )
     */
    private $qteBas;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_tot", type="integer", nullable=false)
     * @Assert\Type(type="integer")
     * @Assert\Range(
     *      min = 5,
     *      max = 1000,
     *      minMessage = "La valeur minimum est de 5 ml",
     *      maxMessage = "La valeur maximum est de 1000 ml",
     *      invalidMessage = "Entrez un nombre entier, entre 5 et 1000",
     * )
     */
    private $qteTot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_stee", type="date", nullable=false)
     */
    private $datStee;

    /**
     * @var string
     *
     * @ORM\Column(name="eta_stee", type="string", length=5, nullable=false, options={"fixed"=true})
     * @Assert\Regex("/(STEEP|PRETE|FINIE)/")
     * @Assert\Length(
     *  min=5,
     *  max=5,
     *  minMessage ="Seuls les mots STEEP, PRETE ou FINIE sont acceptés",
     *  maxMessage ="Seuls les mots STEEP, PRETE ou FINIE sont acceptés")
     */
    private $etaStee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="com_member", type="text", length=0, nullable=true)
     * @Assert\Length(
     *  min=3,
     *  max=70,
     *  minMessage="Votre commentaire doit comporter 3 caractères minimum",
     *  maxMessage="Votre commentaire doit comporter 70 caractères maximum")
     */
    private $comMember;

    /**
     * @var string
     *
     * @ORM\Column(name="aff_recet", type="string", length=3, nullable=false, options={"fixed"=true})
     * @Assert\Regex("/(oui|non)/i")
     * @Assert\Length(
     *  min=3,
     *  max=3,
     *  minMessage ="Seuls les mots oui ou non sont acceptés",
     *  maxMessage ="Seuls les mots oui ou non sont acceptés")
     */
    private $affRecet='oui';

    /**
     * @var int
     *
     * @ORM\Column(name="etoiles", type="integer", nullable=false)
     * @Assert\Type(type="integer")
     * @Assert\Range(
     *      min=0,
     *      max=5,
     *      minMessage = "La note minimum est de 0",
     *      maxMessage = "La note maximum est de 5",
     *      invalidMessage = "Entrez un nombre entier, entre 0 et 5",
     * )
     */
    private $etoiles=0;

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
     * @ORM\OneToMany(targetEntity="App\Entity\AromeRecette", mappedBy="idRecet", orphanRemoval=true, cascade={"all"})
     * @Assert\Valid
     */
    private $aromeRecettes;

    public function __construct()
    {
        $this->aromeRecettes = new ArrayCollection();
        $this->datRecet = new \DateTime();
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
        $this->etaStee = strtoupper($etaStee);

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
