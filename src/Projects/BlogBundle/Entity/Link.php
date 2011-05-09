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
 * @orm:Table(name="link")
 */
class Link
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
}
