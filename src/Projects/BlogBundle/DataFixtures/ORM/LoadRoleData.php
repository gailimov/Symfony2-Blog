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
use Projects\BlogBundle\Entity\Role;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $roleAdmin = new Role();
        $roleAdmin->setName('admin');
        $roleAdmin->setDescription('Администратор');
        $manager->persist($roleAdmin);

        $roleUser = new Role();
        $roleUser->setName('user');
        $roleUser->setDescription('Пользователь');
        $manager->persist($roleUser);

        $manager->flush();

        $this->addReference('role-admin', $roleAdmin);
        $this->addReference('role-user',  $roleUser);
    }

    public function getOrder()
    {
        return 1;
    }
}
