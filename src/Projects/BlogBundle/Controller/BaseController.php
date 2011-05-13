<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Base controller
 */
class BaseController extends Controller
{
    /**
     * Entity manager
     * 
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Configuration
     * 
     * @var array
     */
    protected $config = array('titleSeparator' => '::');

    /**
     * Title
     * 
     * @var string
     */
    protected $title;

    /**
     * Description
     * 
     * @var string
     */
    protected $description;

    /**
     * Pages
     * 
     * @var array
     */
    protected $pages;

    /**
     * Categories
     * 
     * @var array
     */
    protected $categories;

    /**
     * Comments moderation status
     * 
     * @var integer
     */
    protected $commentsModerated;

    /**
     * Initialize
     * 
     * @return void
     */
    protected function init()
    {
        $this->em                = $this->getEm();
        $config                  = $this->em->getRepository('ProjectsBlogBundle:Config')->get();
        $this->title             = $config->getTitle();
        $this->description       = $config->getDescription();
        $this->commentsModerated = $config->getCommentsModerated();
        $this->pages             = $this->em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $this->categories        = $this->em->getRepository('ProjectsBlogBundle:Category')->getAll();
    }

    /**
     * Get entity manager
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        if ($this->em == null) {
            $this->em = $this->get('doctrine.orm.entity_manager');
        }
        return $this->em;
    }
}
