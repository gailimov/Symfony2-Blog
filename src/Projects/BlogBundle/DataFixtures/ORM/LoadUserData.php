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
use Projects\BlogBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setFirstname('Bob');
        $user1->setEmail('admin@example.com');
        $user1->setUrl('http://example.com');
        $user1->setPassword('admin');
        $user1->setSalt('salt');
        $user1->setBanned('0');
        $user1->setDeleted('0');
        $user1->setRoleId($manager->merge($this->getReference('role-admin')));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('Vasyapupkin');
        $user2->setFirstname('Vasya');
        $user2->setEmail('vasya@pupkin.ru');
        $user2->setPassword('password');
        $user2->setSalt('salt');
        $user2->setBanned('0');
        $user2->setDeleted('0');
        $user2->setRoleId($manager->merge($this->getReference('role-user')));
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }

    public function getOrder()
    {
        return 2;
    }
}
