<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 */
class Posts
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=0, nullable=false)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=255, nullable=false)
     */
    private $media;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfLikes", type="integer", nullable=false)
     */
    private $numberoflikes = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfComments", type="integer", nullable=false)
     */
    private $numberofcomments = '0';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="idPost")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StudentProfile", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idStudent;
    

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getNumberoflikes(): ?int
    {
        return $this->numberoflikes;
    }

    public function setNumberoflikes(int $numberoflikes): self
    {
        $this->numberoflikes = $numberoflikes;

        return $this;
    }

    public function getNumberofcomments(): ?int
    {
        return $this->numberofcomments;
    }

    public function setNumberofcomments(int $numberofcomments): self
    {
        $this->numberofcomments = $numberofcomments;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdPost($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdPost() === $this) {
                $comment->setIdPost(null);
            }
        }

        return $this;
    }

    public function getIdStudent(): ?StudentProfile
    {
        return $this->idStudent;
    }

    public function setIdStudent(?StudentProfile $idStudent): self
    {
        $this->idStudent = $idStudent;

        return $this;
    }


}
