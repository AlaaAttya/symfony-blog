<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * Comment post
     * 
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Post",inversedBy="comments")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $post;


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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * Get post
     *
     * @return \BlogBundle\Entity\Post 
     */
    public function getPost() {
        return $this->post;
    }

    /**
     * Set Post
     *
     * @param \BlogBundle\Entity\Post $Post
     * @return Post
     */
    public function setVendor(\BlogBundle\Entity\Post $post = null) {
        $this->post = $post;
        return $this;
    }
}

