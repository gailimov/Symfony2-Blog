<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\Category
 * 
 * @orm:Entity
 * @orm:Table(name="sfb_category")
 */
class Category
{
    /**
     * ID
     * 
     * @var integer
     * 
     * @orm:Id
     * @orm:Column(type="tinyint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
}
