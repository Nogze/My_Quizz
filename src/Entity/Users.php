<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable', options: ["default" => "CURRENT_TIMESTAMP"])]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable', options: ["default" => "CURRENT_TIMESTAMP"])]
    private $login_at;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: QuizzResults::class)]
    private $quizzResults;

    public function __construct(){
        $this->created_at = new \DateTimeImmutable();
        $this->login_at = new \DateTimeImmutable();
        $this->quizzResults = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLoginAt(): ?\DateTimeImmutable
    {
        return $this->login_at;
    }

    public function setLoginAt(\DateTimeImmutable $login_at): self
    {
        $this->login_at = $login_at;

        return $this;
    }

    public function getIsVerified(): ?bool{
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self{
        $this->isVerified = $isVerified;
        return $this;
    }

    /**
     * @return Collection<int, QuizzResults>
     */
    public function getQuizzResults(): Collection
    {
        return $this->quizzResults;
    }

    public function addQuizzResult(QuizzResults $quizzResult): self
    {
        if (!$this->quizzResults->contains($quizzResult)) {
            $this->quizzResults[] = $quizzResult;
            $quizzResult->setUserId($this);
        }

        return $this;
    }

    public function removeQuizzResult(QuizzResults $quizzResult): self
    {
        if ($this->quizzResults->removeElement($quizzResult)) {
            // set the owning side to null (unless already changed)
            if ($quizzResult->getUserId() === $this) {
                $quizzResult->setUserId(null);
            }
        }

        return $this;
    }
}
