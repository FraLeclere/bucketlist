<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WishRepository::class)
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Your Bucket must have a title!")
     * @Assert\Length(
     *     min=4,
     *     max=40,
     *     minMessage="Too short! 4 characters minimum!",
     *     maxMessage="Too long! 40 characters maximum!",
     * )
     *
     * @ORM\Column(type="string" , length=250, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string" , length=50, nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean" ,nullable=false)
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime" ,nullable=false)
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="wishes")
     */
    private $categories;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }



    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }



}
