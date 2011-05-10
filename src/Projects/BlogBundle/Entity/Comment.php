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
 * @orm:Entity
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
     * @orm:Column(type="mediumint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * ID of post
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Post")
     * @orm:JoinColumn(name="post_id", referencedColumnName="id")
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
     * @orm:Column(type="boolean", columnDefinition="UNSIGNED DEFAULT '1'")
     */
    protected $approved;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
}
