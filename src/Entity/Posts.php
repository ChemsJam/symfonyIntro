<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $likes = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_publicacion = null;

    #[ORM\Column(length: 80000)]
    private ?string $contenido = null;

    #[ORM\ManyToOne(inversedBy: 'post_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'Post_id', targetEntity: Comentarios::class, orphanRemoval: true)]
    private Collection $Post_id;

    public function __construct()
    {
        $this->Post_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(?string $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

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

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): static
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Comentarios>
     */
    public function getPostId(): Collection
    {
        return $this->Post_id;
    }

    public function addPostId(Comentarios $postId): static
    {
        if (!$this->Post_id->contains($postId)) {
            $this->Post_id->add($postId);
            $postId->setPostId($this);
        }

        return $this;
    }

    public function removePostId(Comentarios $postId): static
    {
        if ($this->Post_id->removeElement($postId)) {
            // set the owning side to null (unless already changed)
            if ($postId->getPostId() === $this) {
                $postId->setPostId(null);
            }
        }

        return $this;
    }
}
