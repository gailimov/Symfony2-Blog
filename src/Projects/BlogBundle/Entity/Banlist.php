<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Entity;

/**
 * Projects\BlogBundle\Entity\Banlist
 * 
 * @orm:Entity
 * @orm:Table(name="sfb_banlist")
 */
class Banlist
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
     * ID of user
     * 
     * @var integer
     * 
     * @orm:ManyToOne(targetEntity="User")
     * @orm:JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $userId;

    /**
     * Expire time
     * 
     * @var integer
     * 
     * @orm:Column(name="expire_at", type="datetime")
     */
    protected $expireAt;

    public function __construct()
    {
        $this->expireAt = new \DateTime();
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
     * Set expireAt
     *
     * @param datetime $expireAt
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;
    }

    /**
     * Get expireAt
     *
     * @return datetime $expireAt
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * Set userId
     *
     * @param Projects\BlogBundle\Entity\User $userId
     */
    public function setUserId(\Projects\BlogBundle\Entity\User $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get userId
     *
     * @return Projects\BlogBundle\Entity\User $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
