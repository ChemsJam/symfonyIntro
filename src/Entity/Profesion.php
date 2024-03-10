<?php

namespace App\Entity;

use App\Repository\ProfesionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesionRepository::class)]
class Profesion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'profesion')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $profesion_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getProfesionId(): ?User
    {
        return $this->profesion_id;
    }

    public function setProfesionId(?User $profesion_id): static
    {
        $this->profesion_id = $profesion_id;

        return $this;
    }
}
