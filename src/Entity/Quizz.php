<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzRepository::class)]
class Quizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $creation_date;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: Questions::class)]
    private $questions;

    #[ORM\ManyToMany(targetEntity: QuizzResults::class, mappedBy: 'quizz_id')]
    private $quizzResults;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $author;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->creation_date = new \DateTime('now');
        $this->quizzResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Questions $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuizz($this);
        }

        return $this;
    }

    public function removeQuestion(Questions $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuizz() === $this) {
                $question->setQuizz(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->id;
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
            $quizzResult->addQuizzId($this);
        }

        return $this;
    }

    public function removeQuizzResult(QuizzResults $quizzResult): self
    {
        if ($this->quizzResults->removeElement($quizzResult)) {
            $quizzResult->removeQuizzId($this);
        }

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }
}
