<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\Comment
 * 
 * @orm:Entity(repositoryClass="Projects\BlogBundle\Repository\CommentRepository")
 * @orm:Table(name="sfb_comment")
 */
class Comment
{
    /**
     * ID
     * 
     * @var integer
     * 
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * ID of post
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Post")
     * @orm:JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     */
    protected $postId;

    /**
     * ID of user
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="User")
     * @orm:JoinColumn(name="user_id", nullable=true, referencedColumnName="id")
     */
    protected $userId;

    /**
     * Author
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", nullable=true)
     */
    protected $author;

    /**
     * Email
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", nullable=true)
     */
    protected $email;

    /**
     * URL
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", nullable=true)
     */
    protected $url;

    /**
     * Comment
     * 
     * @var string
     * 
     * @orm:Column(type="text")
     */
    protected $comment;

    /**
     * Created time
     * 
     * @var integer
     * 
     * @orm:Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * IP
     * 
     * @var integer
     * 
     * @orm:Column(type="integer", nullable=true)
     */
    protected $ip;

    /**
     * User Agent
     * 
     * @var string
     * 
     * @orm:Column(name="user_agent", type="string", length="100", nullable=true)
     */
    protected $userAgent;

    /**
     * Is approved?
     * 
     * @var boolean
     * 
     * @orm:Column(columnDefinition="TINYINT(1) UNSIGNED DEFAULT '1'")
     */
    protected $approved;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text $comment
     */
    public function getComment()
    {
        return $this->comment;
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
     * Set ip
     *
     * @param integer $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get ip
     *
     * @return integer $ip
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get userAgent
     *
     * @return string $userAgent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
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
     * Set postId
     *
     * @param Projects\BlogBundle\Entity\Post $postId
     */
    public function setPostId(\Projects\BlogBundle\Entity\Post $postId)
    {
        $this->postId = $postId;
    }

    /**
     * Get postId
     *
     * @return Projects\BlogBundle\Entity\Post $postId
     */
    public function getPostId()
    {
        return $this->postId;
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
}
