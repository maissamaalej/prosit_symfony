<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $numshow = null;


    #[ORM\Column]
    private ?int $nbrseat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateshow = null;

    #[ORM\ManyToOne(inversedBy: 'shows')]
    private ?TheatrePlay $relation = null;

    public function __construct()
    {
        $this->nbrseat = 30;
    }

    public function getNumshow(): ?int
    {
        return $this->numshow;
    }

    public function setNumshow(int $numshow): static
    {
        $this->numshow = $numshow;

        return $this;
    }

    public function getNbrseat(): ?int
    {
        return $this->nbrseat;
    }

    public function setNbrseat(int $nbrseat): static
    {
        $this->nbrseat = $nbrseat;

        return $this;
    }

    public function getDateshow(): ?\DateTimeInterface
    {
        return $this->dateshow;
    }

    public function setDateshow(\DateTimeInterface $dateshow): static
    {
        $this->dateshow = $dateshow;

        return $this;
    }

    public function getRelation(): ?TheatrePlay
    {
        return $this->relation;
    }

    public function setRelation(?TheatrePlay $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
