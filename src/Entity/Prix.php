<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string|null
     *
     * @ORM\Column(name="prix", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="qte_btlle", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $qteBtlle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournis", type="text", length=0, nullable=true)
     */
    private $fournis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="e_com", type="text", length=0, nullable=true)
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
