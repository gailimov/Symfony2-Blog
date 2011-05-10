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
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * ID of role
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="Role")
     * @orm:JoinColumn(name="role_id", referencedColumnName="id", nullable=false)
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
     * @orm:Column(name="logged_at", type="datetime", nullable=true)
     */
    protected $loggedAt;

    /**
     * Is banned?
     * 
     * @var boolean
     * 
     * @orm:Column(columnDefinition="TINYINT(1) UNSIGNED DEFAULT '0'")
     */
    protected $banned;

    /**
     * Is deleted?
     * 
     * @var boolean
     * 
     * @orm:Column(columnDefinition="TINYINT(1) UNSIGNED DEFAULT '0'")
     */
    protected $deleted;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->loggedAt  = new \DateTime();
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
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
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string $salt
     */
    public function getSalt()
    {
        return $this->salt;
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
     * Set loggedAt
     *
     * @param datetime $loggedAt
     */
    public function setLoggedAt($loggedAt)
    {
        $this->loggedAt = $loggedAt;
    }

    /**
     * Get loggedAt
     *
     * @return datetime $loggedAt
     */
    public function getLoggedAt()
    {
        return $this->loggedAt;
    }

    /**
     * Set banned
     *
     * @param string $banned
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;
    }

    /**
     * Get banned
     *
     * @return string $banned
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Set deleted
     *
     * @param string $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return string $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set roleId
     *
     * @param Projects\BlogBundle\Entity\Role $roleId
     */
    public function setRoleId(\Projects\BlogBundle\Entity\Role $roleId)
    {
        $this->roleId = $roleId;
    }

    /**
     * Get roleId
     *
     * @return Projects\BlogBundle\Entity\Role $roleId
     */
    public function getRoleId()
    {
        return $this->roleId;
    }
}
