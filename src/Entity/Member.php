<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_member", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMember;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_member", type="string", length=20, nullable=false)
     */
    private $nomMember;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_member", type="string", length=35, nullable=false)
     */
    private $mailMember;

    /**
     * @var string
     *
     * @ORM\Column(name="aff_member", type="string", length=3, nullable=false, options={"fixed"=true})
     */
    private $affMember;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="text", length=0, nullable=true)
     */
    private $password;

    public function getIdMember(): ?int
    {
        return $this->idMember;
    }

    public function getNomMember(): ?string
    {
        return $this->nomMember;
    }

    public function setNomMember(string $nomMember): self
    {
        $this->nomMember = $nomMember;

        return $this;
    }

    public function getMailMember(): ?string
    {
        return $this->mailMember;
    }

    public function setMailMember(string $mailMember): self
    {
        $this->mailMember = $mailMember;

        return $this;
    }

    public function getAffMember(): ?string
    {
        return $this->affMember;
    }

    public function setAffMember(string $affMember): self
    {
        $this->affMember = $affMember;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }


}
