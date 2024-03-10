<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $baneado = false;
    


    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'usuario_id', targetEntity: Comentarios::class, orphanRemoval: true)]
    private Collection $comentarios;

    #[ORM\OneToMany(mappedBy: 'profesion_id', targetEntity: Profesion::class, orphanRemoval: true)]
    private Collection $profesion;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Posts::class, orphanRemoval: true)]
    private Collection $post_id;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->profesion = new ArrayCollection();
        $this->post_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
    return $this->name;
    }
 
    public function setName(?string $name): static
    {
    $this->name = $name;

    return $this;
    }

    public function isBaneado(): ?bool
    {
    return $this->baneado;
    }

    public function setBaneado(?bool $baneado): static
    {
    $this->baneado = $baneado;

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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Comentarios>
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentarios $comentario): static
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios->add($comentario);
            $comentario->setUsuarioId($this);
        }

        return $this;
    }

    public function removeComentario(Comentarios $comentario): static
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getUsuarioId() === $this) {
                $comentario->setUsuarioId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Profesion>
     */
    public function getProfesion(): Collection
    {
        return $this->profesion;
    }

    public function addProfesion(Profesion $profesion): static
    {
        if (!$this->profesion->contains($profesion)) {
            $this->profesion->add($profesion);
            $profesion->setProfesionId($this);
        }

        return $this;
    }

    public function removeProfesion(Profesion $profesion): static
    {
        if ($this->profesion->removeElement($profesion)) {
            // set the owning side to null (unless already changed)
            if ($profesion->getProfesionId() === $this) {
                $profesion->setProfesionId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Posts>
     */
    public function getPostId(): Collection
    {
        return $this->post_id;
    }

    public function addPostId(Posts $postId): static
    {
        if (!$this->post_id->contains($postId)) {
            $this->post_id->add($postId);
            $postId->setUserId($this);
        }

        return $this;
    }

    public function removePostId(Posts $postId): static
    {
        if ($this->post_id->removeElement($postId)) {
            // set the owning side to null (unless already changed)
            if ($postId->getUserId() === $this) {
                $postId->setUserId(null);
            }
        }

        return $this;
    }
}
