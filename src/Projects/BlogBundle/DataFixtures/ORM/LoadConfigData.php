<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Projects\BlogBundle\Entity\Config;

class LoadConfigData implements FixtureInterface
{
    public function load($manager)
    {
        $config = new Config();
        $config->setId('1');
        $config->setUrl('http://projects.loc/sfblog');
        $config->setTitle('Тестовый блог на Symfony');
        $config->setDescription('Тестовый блог разработанный с помощью PHP-фреймворка Symfony');
        $config->setPostsNum('10');
        $config->setCommentsModerated('0');
        $config->setPostsModerated('0');
        $manager->persist($config);

        $manager->flush();
    }
}
