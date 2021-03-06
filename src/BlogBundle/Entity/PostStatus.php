<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostStatus
 *
 * @ORM\Table(name="post_status")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostStatusRepository")
 */
class PostStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Post", mappedBy="post_status" ,cascade={"all", "remove"})
     */
    private $posts;

    public function getPosts() {
        return $this->posts;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PostStatus
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function __toString() {
        return $this->title;
    }
}

