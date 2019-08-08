<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Base
 *
 * @ORM\Table(name="base")
 * @ORM\Entity(repositoryClass="App\Repository\BaseRepository")
 */
class Base
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_base", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBase;

    /**
     * @var int
     *
     * @ORM\Column(name="dos_pg", type="integer", nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^([1][0][0])|([1-9][0]|[0])$/")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Le dosage minimum est de 0 %",
     *      maxMessage = "Le dosage maximum est de 100 %",
     *      invalidMessage = "Entrez un multiple de 10, entre 0 et 100 %",
     * )
     */
    private $dosPg;

    /**
     * @var int
     *
     * @ORM\Column(name="dos_vg", type="integer", nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/^([1][0][0])|([1-9][0]|[0])$/")
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "Le dosage minimum est de 0 %",
     *      maxMessage = "Le dosage maximum est de 100 %",
     *      invalidMessage = "Entrez un multiple de 10, entre 0 et 100 %",
     * )
     */
    private $dosVg;

    /**
     * @var string
     *
     * @ORM\Column(name="correctif", type="decimal", precision=2, scale=1, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/[0-2](\.[0-9]|\,[0-9])/")
     * @Assert\Range(
     *      min = 0.1,
     *      max = 2,
     *      minMessage = "La valeur minimum est de 0.1",
     *      maxMessage = "La valeur maximum est de 2",
     *      invalidMessage = "Entrez une valeur entière ou à une décimale, entre 0.1 et 2",
     * )
     */
    private $correctif;

    public function getIdBase(): ?int
    {
        return $this->idBase;
    }

    public function getDosPg(): ?int
    {
        return $this->dosPg;
    }

    public function setDosPg(int $dosPg): self
    {
        $this->dosPg = $dosPg;

        return $this;
    }

    public function getDosVg(): ?int
    {
        return $this->dosVg;
    }

    public function setDosVg(int $dosVg): self
    {
        $this->dosVg = $dosVg;

        return $this;
    }

    public function getCorrectif()
    {
        return $this->correctif;
    }

    public function setCorrectif($correctif): self
    {
        $this->correctif = $correctif;

        return $this;
    }

    public function __toString()
    {
        return strval($this->dosPg)." / ".strval($this->dosVg);
    }
}
