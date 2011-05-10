<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\Role
 * 
 * @orm:Entity
 * @orm:Table(name="sfb_role")
 */
class Role
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
     * @orm:Column(type="string", length="20", unique=true)
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
}
