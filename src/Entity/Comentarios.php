<?php

namespace App\Entity;

use App\Repository\ComentariosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentariosRepository::class)]
class Comentarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $comentario = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_publicacion = null;

    #[ORM\ManyToOne(inversedBy: 'comentarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usuario_id = null;

    #[ORM\ManyToOne(inversedBy: 'Post_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Posts $Post_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): static
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    public function getUsuarioId(): ?User
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(?User $usuario_id): static
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function getPostId(): ?Posts
    {
        return $this->Post_id;
    }

    public function setPostId(?Posts $Post_id): static
    {
        $this->Post_id = $Post_id;

        return $this;
    }
}
