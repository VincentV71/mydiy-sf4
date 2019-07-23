<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="FK_REDIGER", columns={"id_member"}), @ORM\Index(name="FK_COMMENTER", columns={"id_recet"})})
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_avis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    /**
     * @var string
     *
     * @ORM\Column(name="text_avi", type="text", length=500, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *  min="5",
     *  max="500",
     *  minMessage="Votre commentaire doit comporter 5 caractères minimum",
     *  maxMessage="Votre commentaire doit comporter 500 caractères maximum")
     */
    private $textAvi;

    /**
     * @var int
     *
     * @ORM\Column(name="note_avi", type="smallint", nullable=false)
     * @Assert\Type(type="integer")
     * @Assert\NotBlank(message="Noter cette recette (de 0 à 5) est obligatoire")
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "La note minimum est de 0",
     *      maxMessage = "La note maximum est de 5",
     *      invalidMessage = "Entrez un nombre entier, entre 0 et 5",
     * )
     */
    private $noteAvi;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_avi", type="date", nullable=true)
     */
    private $dateAvi;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aff_avi", type="string", length=3, nullable=true)
     * @Assert\Regex("/(oui|non)/i")
     * @Assert\Length(
     *  min="3",
     *  max="3",
     *  minMessage ="Seuls les mots oui ou non sont acceptés",
     *  maxMessage ="Seuls les mots oui ou non sont acceptés")
     */
    private $affAvi;

    /**
     * @var \Recette
     *
     * @ORM\ManyToOne(targetEntity="Recette")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recet", referencedColumnName="id_recet")
     * })
     */
    private $idRecet;

    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_member", referencedColumnName="id_member")
     * })
     */
    private $idMember;

    public function getIdAvis(): ?int
    {
        return $this->idAvis;
    }

    public function getTextAvi(): ?string
    {
        return $this->textAvi;
    }

    public function setTextAvi(?string $textAvi): self
    {
        $this->textAvi = $textAvi;

        return $this;
    }

    public function getNoteAvi(): ?int
    {
        return $this->noteAvi;
    }

    public function setNoteAvi(?int $noteAvi): self
    {
        $this->noteAvi = $noteAvi;

        return $this;
    }

    public function getDateAvi(): ?\DateTimeInterface
    {
        return $this->dateAvi;
    }

    public function setDateAvi(?\DateTimeInterface $dateAvi): self
    {
        $this->dateAvi = $dateAvi;

        return $this;
    }

    public function getAffAvi(): ?string
    {
        return $this->affAvi;
    }

    public function setAffAvi(?string $affAvi): self
    {
        $this->affAvi = $affAvi;

        return $this;
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

    public function getIdMember(): ?Member
    {
        return $this->idMember;
    }

    public function setIdMember(?Member $idMember): self
    {
        $this->idMember = $idMember;

        return $this;
    }
}
