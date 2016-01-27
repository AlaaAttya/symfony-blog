<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var ArrayCollection 
     * 
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Category", inversedBy="posts")
     * @ORM\JoinTable(name="posts_categories",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     * */
    private $categories;

     /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Comment", mappedBy="post" ,cascade={"all", "remove"})
     */
    private $comments;


    /**
     * 
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\PostStatus", inversedBy="posts")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $post_status;

    /**
     * Constructor
     */
    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Post
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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


        /**
     * Add categories
     *
     * @param \BlogBundle\Entity\Category $categories
     * @return Venue
     */
    public function addCategory(\BlogBundle\Entity\Category $categories) {
        $this->categories[] = $categories;
        return $this;
    }
    /**
     * Remove categories
     *
     * @param \Dalilak\VenueBundle\Entity\Category $categories
     */
    public function removeCategory(\BlogBundle\Entity\Category $categories) {
        $this->categories->removeElement($categories);
    }
    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * Add comments
     *
     * @param \BlogBundle\Entity\Comment $comments
     * @return Venue
     */
    public function addComment(\BlogBundle\Entity\Comment $comment) {
        $this->comments[] = $comment;
        return $this;
    }
    /**
     * Remove comments
     *
     * @param \BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\BlogBundle\Entity\Comment $comments) {
        $this->comments->removeElement($comments);
    }

    public function getPostStatus() {
        return $this->post_status;
    }

    public function setPostStatus($post_status) {
        $this->post_status = $post_status;
        return $this;
    }

    public function __toString() {
        return $this->title;
    }
}

