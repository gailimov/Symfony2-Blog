<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * @orm:Entity
 * @orm:Table(name="post")
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
     * @orm:ManyToOne(targetEntity="Category")
     * @orm:JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $categoryId;

    /**
     * ID of user
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="User")
     * @orm:JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $userId;

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
     * @orm:Column(type="mediumtext")
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
     * @orm:Column(type="mediumint", columnDefinition="MEDIUMINT(7) UNSIGNED DEFAULT '0'")
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
     * @orm:Column(type="boolean", columnDefinition="UNSIGNED DEFAULT '1'")
     */
    protected $published;

    /**
     * Is comments closed?
     * 
     * @var boolean
     * 
     * @orm:Column(name="comments_closed", type="boolean", columnDefinition="UNSIGNED DEFAULT '0'")
     */
    protected $commentsClosed;

    /**
     * Is approved?
     * 
     * @var boolean
     * 
     * @orm:Column(type="bool", columnDefinition="UNSIGNED DEFAULT '1'")
     */
    protected $approved;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
}
