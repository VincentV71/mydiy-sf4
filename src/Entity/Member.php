<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * @UniqueEntity(
 *  fields={"mailMember"},
 *  message="L'email que vous avez indiqué est déjà utilisé"
 * )
 */
class Member implements UserInterface
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
     * @Assert\Length(
     *  min="3",
     *  max="20",
     *  minMessage ="Votre pseudo doit comporter 3 caractères minimum",
     *  maxMessage ="Votre pseudo doit comporter 20 caractères maximum")
     */
    private $nomMember;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_member", type="string", length=35, nullable=false)
     * @Assert\Email()
     * @Assert\Length(
     *  min="5",
     *  max="35",
     *  minMessage="L'Email doit comporter 5 caractères minimum",
     *  maxMessage="L'Email doit comporter 35 caractères maximum")
     */
    private $mailMember;

    /**
     * @var string
     *
     * @ORM\Column(name="aff_member", type="string", length=3, nullable=false, options={"fixed"=true})
     * @Assert\Regex("/(oui|non)/i")
     * @Assert\Length(
     *  min="3",
     *  max="3",
     *  minMessage ="Seuls les mots oui ou non sont acceptés ici",
     *  maxMessage ="Seuls les mots oui ou non sont acceptés ici")
     */
    private $affMember;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="text", length=0, nullable=false)
     * @Assert\Length(
     *  min="3",
     *  minMessage ="Votre mot de passe doit comporter 3 caractères minimum")
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

    public function __toString()
    {
        return strval($this->idMember);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
    }


    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->nomMember;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
