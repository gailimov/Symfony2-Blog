<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\User
 * 
 * @orm:Entity
 * @orm:Table(name="sfb_user")
 */
class User
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
     * ID of role
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Role")
     * @orm:JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $roleId;

    /**
     * Username
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", unique=true)
     */
    protected $username;

    /**
     * Firstname
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50", nullable=true)
     */
    protected $firstname;

    /**
     * Email
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="50")
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
     * Password
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="32")
     */
    protected $password;

    /**
     * Salt
     * 
     * @var string
     * 
     * @orm:Column(type="string", length="32")
     */
    protected $salt;

    /**
     * Created time
     * 
     * @var integer
     * 
     * @orm:Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Logged time
     * 
     * @var integer
     * 
     * @orm:Column(name="logged_at", type="datetime")
     */
    protected $loggedAt;

    /**
     * Is banned?
     * 
     * @var boolean
     * 
     * @orm:Column(type="boolean", columnDefinition="UNSIGNED DEFAULT '0'")
     */
    protected $banned;

    /**
     * Is deleted?
     * 
     * @var boolean
     * 
     * @orm:Column(type="boolean", columnDefinition="UNSIGNED DEFAULT '0'")
     */
    protected $deleted;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->loggedAt  = new \DateTime();
    }
}
