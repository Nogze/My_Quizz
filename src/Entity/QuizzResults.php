<?php

namespace App\Entity;

use App\Repository\QuizzResultsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzResultsRepository::class)]
class QuizzResults
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'quizzResults')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Quizz::class, inversedBy: 'quizzResults')]
    private $quizz;

    #[ORM\Column(type: 'integer')]
    private $result;

    public function __construct()
    {
        $this->quizz = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?Users
    {
        return $this->user;
    }

    public function setUserId(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizzId(): Collection
    {
        return $this->quizz;
    }

    public function setQuizzId(?Quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function addQuizzId(Quizz $quizzId): self
    {
        if (!$this->quizz->contains($quizzId)) {
            $this->quizz[] = $quizzId;
        }

        return $this;
    }

    public function removeQuizzId(Quizz $quizzId): self
    {
        $this->quizz->removeElement($quizzId);

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(int $result): self
    {
        $this->result = $result;

        return $this;
    }
}
