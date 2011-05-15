<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Projects\BlogBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $category1 = new Category();
        $category1->setSlug('first-cat');
        $category1->setTitle('Первая категория');
        $category1->setDescription('Первая тестовая категория');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setSlug('second-cat');
        $category2->setTitle('Вторая категория');
        $category2->setDescription('Вторая тестовая категория');
        $manager->persist($category2);

        $manager->flush();

        $this->addReference('category1', $category1);
        $this->addReference('category2', $category2);
    }

    public function getOrder()
    {
        return 3;
    }
}
