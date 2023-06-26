<?php

namespace App\Entity;

use App\Repository\FilmsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmsRepository::class)]
class Films
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $rating_vote_count = null;

    #[ORM\Column(length: 200)]
    private ?string $poster_url = null;

    #[ORM\Column(length: 200)]
    private ?string $poster_url_preview = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getRatingVoteCount(): ?int
    {
        return $this->rating_vote_count;
    }

    public function setRatingVoteCount(int $rating_vote_count): static
    {
        $this->rating_vote_count = $rating_vote_count;

        return $this;
    }

    public function getPosterUrl(): ?string
    {
        return $this->poster_url;
    }

    public function setPosterUrl(string $poster_url): static
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getPosterUrlPreview(): ?string
    {
        return $this->poster_url_preview;
    }

    public function setPosterUrlPreview(string $poster_url_preview): static
    {
        $this->poster_url_preview = $poster_url_preview;

        return $this;
    }
}
