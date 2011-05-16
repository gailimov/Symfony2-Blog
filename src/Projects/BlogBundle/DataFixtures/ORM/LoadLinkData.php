<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Projects\BlogBundle\Entity\Link;

class LoadLinkData implements FixtureInterface
{
    public function load($manager)
    {
        $link1 = new Link();
        $link1->setUrl('http://it-guest.net.ru');
        $link1->setTitle('IT - гость');
        $link1->setDescription('В гостях как дома, только не трогайте компьютер');
        $manager->persist($link1);

        $link2 = new Link();
        $link2->setUrl('http://www.zeroxor.ru');
        $link2->setTitle('Блог веб-фрилансера');
        $link2->setDescription("Блог ZeroXor'а");
        $manager->persist($link2);

        $manager->flush();
    }
}
