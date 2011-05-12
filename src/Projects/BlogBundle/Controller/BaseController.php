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
     * Main title
     * 
     * @var string
     */
    protected $mainTitle;

    /**
     * Description
     * 
     * @var string
     */
    protected $description;

    public function __construct()
    {
        $this->mainTitle   = 'Блог';
        $this->description = 'Тест';
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
