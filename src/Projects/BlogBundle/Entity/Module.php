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
 * @orm:Table(name="module")
 */
class Module
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
     * Name
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", unique=true)
     */
    protected $name;

    /**
     * Description
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="100", nullable=true)
     */
    protected $description;

    /**
     * Author
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", nullable=true)
     */
    protected $author;

    /**
     * Version
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="10", nullable=true)
     */
    protected $version;

    /**
     * Is activated?
     * 
     * @var boolean
     * 
     * @orm:Column(type="boolean")
     */
    protected $activated;
}
