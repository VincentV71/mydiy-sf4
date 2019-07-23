<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Prix
 *
 * @ORM\Table(name="prix", indexes={@ORM\Index(name="FK_VENDRE", columns={"id_aro"})})
 * @ORM\Entity(repositoryClass="App\Repository\PrixRepository")
 */
class Prix
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_prix", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrix;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=4, scale=2, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^[0-9]?[0-9]*(\.|\,)?[0-9]?[05]?$/")
     * @Assert\Range(
     *    min = 0.05,
     *    max = 100,
     *    minMessage = "La valeur minimum est de 0.05",
     *    maxMessage = "La valeur maximum est de 100",
     *    invalidMessage = "Entrez un nombre entier ou décimal, entre 0.5 et 100",
     *  )
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="qte_btlle", type="decimal", precision=3, scale=1, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^[1-9]?[0-9]*(\.|\,)?[05]?$/")
     * @Assert\Range(
     *    min = 10,
     *    max = 50,
     *    minMessage = "La valeur minimum est de 10",
     *    maxMessage = "La valeur maximum est de 50",
     *    invalidMessage = "Entrez un nombre entier ou décimal, entre 10 et 50",
     *  )
     */
    private $qteBtlle;

    /**
     * @var string
     *
     * @ORM\Column(name="fournis", type="text", length=0, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *  min="3",
     *  max="40",
     *  minMessage="Le nom du fournisseur doit comporter 3 caractères minimum",
     *  maxMessage="Le nom du fournisseur doit comporter 40 caractères maximum")
     */
    private $fournis;

    /**
     * @var string
     *
     * @ORM\Column(name="e_com", type="text", length=0, nullable=false)
     * @Assert\NotBlank
     * @Assert\Url(
     *  relativeProtocol = true,
     *  message="Cette adresse web n'est pas valide")
     * @Assert\Length(
     *  min="10",
     *  max="60",
     *  minMessage="L'URL doit comporter 10 caractères minimum",
     *  maxMessage="L'URL doit comporter 60 caractères maximum")
     */
    private $eCom;

    /**
     * @var \Arome
     *
     * @ORM\ManyToOne(targetEntity="Arome")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_aro", referencedColumnName="id_aro")
     * })
     */
    private $idAro;

    public function getIdPrix(): ?int
    {
        return $this->idPrix;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQteBtlle()
    {
        return $this->qteBtlle;
    }

    public function setQteBtlle($qteBtlle): self
    {
        $this->qteBtlle = $qteBtlle;

        return $this;
    }

    public function getFournis(): ?string
    {
        return $this->fournis;
    }

    public function setFournis(?string $fournis): self
    {
        $this->fournis = $fournis;

        return $this;
    }

    public function getECom(): ?string
    {
        return $this->eCom;
    }

    public function setECom(?string $eCom): self
    {
        $this->eCom = $eCom;

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
}
