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
    private ?int $ratingVoteCount = null;

    #[ORM\Column(length: 200)]
    private ?string $posterUrl = null;

    #[ORM\Column(length: 200)]
    private ?string $posterUrlPreview = null;

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
        return $this->ratingVoteCount;
    }

    public function setRatingVoteCount(int $ratingVoteCount): static
    {
        $this->ratingVoteCount = $ratingVoteCount;

        return $this;
    }

    public function getPosterUrl(): ?string
    {
        return $this->posterUrl;
    }

    public function setPosterUrl(string $posterUrl): static
    {
        $this->posterUrl = $posterUrl;

        return $this;
    }

    public function getPosterUrlPreview(): ?string
    {
        return $this->posterUrlPreview;
    }

    public function setPosterUrlPreview(string $posterUrlPreview): static
    {
        $this->posterUrlPreview = $posterUrlPreview;

        return $this;
    }
}
