<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $dosPg;

    /**
     * @var int
     *
     * @ORM\Column(name="dos_vg", type="integer", nullable=false)
     */
    private $dosVg;

    /**
     * @var string
     *
     * @ORM\Column(name="correctif", type="decimal", precision=2, scale=1, nullable=false)
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
        return strval($this->idBase);
    }


}
