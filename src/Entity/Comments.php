<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// indexes={@ORM\Index(name="ForeignKey_Comments-idPost_Posts-id", columns={"idPost"})}
/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="userName", type="text", length=65535, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="userPicture", type="text", length=65535, nullable=false)
     */
    private $userpicture;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Posts", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUserpicture(): ?string
    {
        return $this->userpicture;
    }

    public function setUserpicture(string $userpicture): self
    {
        $this->userpicture = $userpicture;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIdPost(): ?Posts
    {
        return $this->idPost;
    }

    public function setIdPost(?Posts $idPost): self
    {
        $this->idPost = $idPost;

        return $this;
    }
}
