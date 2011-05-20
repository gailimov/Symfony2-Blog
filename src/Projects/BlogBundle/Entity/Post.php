<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Projects\BlogBundle\Entity\Post
 * 
 * @orm:Entity(repositoryClass="Projects\BlogBundle\Repository\PostRepository")
 * @orm:Table(name="sfb_post")
 */
class Post
{
    /**
     * ID
     * 
     * @var integer
     * 
     * @orm:Id
     * @orm:Column(type="smallint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * ID of category
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Category", inversedBy="posts")
     * @orm:JoinColumn(name="category_id", nullable=true, referencedColumnName="id")
     */
    protected $categoryId;

    /**
     * ID of user
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="User")
     * @orm:JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $userId;

    /**
     * ID of module
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Module")
     * @orm:JoinColumn(name="module_id", nullable=true, referencedColumnName="id")
     */
    protected $moduleId;

    /**
     * Slug
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", unique=true)
     */
    protected $slug;

    /**
     * Title
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50")
     */
    protected $title;

    /**
     * Description
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="100", nullable=true)
     */
    protected $description;

    /**
     * Post
     * 
     * @var string
     * 
     * @orm:Column(type="text")
     */
    protected $post;

    /**
     * Created time
     * 
     * @var integer
     * 
     * @orm:Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Number of views
     * 
     * @var integer
     * 
     * @orm:Column(columnDefinition="MEDIUMINT(7) UNSIGNED DEFAULT '0'")
     */
    protected $views;

    /**
     * Type
     * 
     * @var string
     * 
     * @orm:Column(name="post_type", type="string", length="5")
     */
    protected $postType;

    /**
     * Is published?
     * 
     * @var boolean
     * 
     * @orm:Column(columnDefinition="TINYINT(1) UNSIGNED DEFAULT '1'")
     */
    protected $published;

    /**
     * Is comments closed?
     * 
     * @var boolean
     * 
     * @orm:Column(name="comments_closed", columnDefinition="TINYINT(1) UNSIGNED DEFAULT '0'")
     */
    protected $commentsClosed;

    /**
     * Is approved?
     * 
     * @var boolean
     * 
     * @orm:Column(columnDefinition="TINYINT(1) UNSIGNED DEFAULT '1'")
     */
    protected $approved;

    /**
     * Comments
     * 
     * @var object
     * 
     * @orm:OneToMany(targetEntity="Comment", mappedBy="postId")
     */
    protected $comments;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->comments = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return smallint $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set post
     *
     * @param text $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * Get post
     *
     * @return text $post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set views
     *
     * @param string $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * Get views
     *
     * @return string $views
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set postType
     *
     * @param string $postType
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;
    }

    /**
     * Get postType
     *
     * @return string $postType
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set published
     *
     * @param string $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get published
     *
     * @return string $published
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set commentsClosed
     *
     * @param string $commentsClosed
     */
    public function setCommentsClosed($commentsClosed)
    {
        $this->commentsClosed = $commentsClosed;
    }

    /**
     * Get commentsClosed
     *
     * @return string $commentsClosed
     */
    public function getCommentsClosed()
    {
        return $this->commentsClosed;
    }

    /**
     * Set approved
     *
     * @param string $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    /**
     * Get approved
     *
     * @return string $approved
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set categoryId
     *
     * @param Projects\BlogBundle\Entity\Category $categoryId
     */
    public function setCategoryId(\Projects\BlogBundle\Entity\Category $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * Get categoryId
     *
     * @return Projects\BlogBundle\Entity\Category $categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set userId
     *
     * @param Projects\BlogBundle\Entity\User $userId
     */
    public function setUserId(\Projects\BlogBundle\Entity\User $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get userId
     *
     * @return Projects\BlogBundle\Entity\User $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set moduleId
     *
     * @param Projects\BlogBundle\Entity\Module $moduleId
     */
    public function setModuleId(\Projects\BlogBundle\Entity\Module $moduleId)
    {
        $this->moduleId = $moduleId;
    }

    /**
     * Get moduleId
     *
     * @return Projects\BlogBundle\Entity\Module $moduleId
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Add comments
     * 
     * @param Projects\BlogBundle\Entity\Comment $comments
     */
    public function addComments(\Projects\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     * 
     * @return \Doctrine\Common\Collections\Collection $comments
     */
    public function getComments()
    {
        return $this->comments;
    }
}
