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
     * @orm:Column(type="mediumint")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
}
