<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\Config
 * 
 * @orm:Entity(repositoryClass="Projects\BlogBundle\Repository\ConfigRepository")
 * @orm:Table(name="sfb_config")
 */
class Config
{
    /**
     * ID
     * 
     * @var integer
     * 
     * @orm:Id
     * @orm:Column(type="smallint")
     */
    protected $id;

    /**
     * URL
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50")
     */
    protected $url;

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
     * Number of posts on the page
     * 
     * @var integer
     * 
     * @orm:Column(name="posts_num", type="smallint")
     */
    protected $postsNum;

    /**
     * Is comments moderated?
     * 
     * @var boolean
     * 
     * @orm:Column(name="comments_moderated", columnDefinition="TINYINT(1) UNSIGNED DEFAULT '0'")
     */
    protected $commentsModerated;

    /**
     * Is posts moderated?
     * 
     * @var boolean
     * 
     * @orm:Column(name="posts_moderated", columnDefinition="TINYINT(1) UNSIGNED DEFAULT '0'")
     */
    protected $postsModerated;

    /**
     * Set id
     *
     * @param smallint $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set postsNum
     *
     * @param smallint $postsNum
     */
    public function setPostsNum($postsNum)
    {
        $this->postsNum = $postsNum;
    }

    /**
     * Get postsNum
     *
     * @return smallint $postsNum
     */
    public function getPostsNum()
    {
        return $this->postsNum;
    }

    /**
     * Set commentsModerated
     *
     * @param string $commentsModerated
     */
    public function setCommentsModerated($commentsModerated)
    {
        $this->commentsModerated = $commentsModerated;
    }

    /**
     * Get commentsModerated
     *
     * @return string $commentsModerated
     */
    public function getCommentsModerated()
    {
        return $this->commentsModerated;
    }

    /**
     * Set postsModerated
     *
     * @param string $postsModerated
     */
    public function setPostsModerated($postsModerated)
    {
        $this->postsModerated = $postsModerated;
    }

    /**
     * Get postsModerated
     *
     * @return string $postsModerated
     */
    public function getPostsModerated()
    {
        return $this->postsModerated;
    }
}
