<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CategoryRepository")
 */
class Category
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
     * @var ArrayCollection 
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Post", mappedBy="categories")
     * */
    private $posts;

    /**
     * Constructor
     */
    public function __construct() {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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

    /**
     * Add posts
     *
     * @param \BlogBundle\Entity\Post
     * @return Category
     */
    public function addCategory(\BlogBundle\Entity\Post $posts) {
        $this->posts[] = $posts;
        return $this;
    }
    /**
     * Remove posts
     *
     * @param \BlogBundle\Entity\Post $posts
     */
    public function removeVenue(\BlogBundle\Entity\Post $posts) {
        $this->posts->removeElement($posts);
    }
    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts() {
        return $this->posts;
    }

    public function __toString() {
        return $this->title;
    }
}

