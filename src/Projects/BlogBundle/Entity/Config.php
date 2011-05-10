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
 * @orm:Entity
 * @orm:Table(name="sfb_config")
 */
class Config
{
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
     * @orm:Column(name="posts_num", type="tinyint")
     */
    protected $postsNum;

    /**
     * Is comments moderated?
     * 
     * @var boolean
     * 
     * @orm:Column(name="comments_moderated", type="boolean", columnDefinition="UNSIGNED DEFAULT '0'")
     */
    protected $commentsModerated;

    /**
     * Is posts moderated?
     * 
     * @var boolean
     * 
     * @orm:Column(name="posts_moderated", type="boolean", columnDefinition="UNSIGNED DEFAULT '0'")
     */
    protected $postsModerated;
}
