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
use Projects\BlogBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $comment1 = new Comment();
        $comment1->setAuthor('Вася');
        $comment1->setEmail('vasya@pupkin.ru');
        $comment1->setUrl('http://vasya.pupkin.ru');
        $comment1->setComment('Аффтар, пеши исчо ^_^');
        $comment1->setIp('1270');
        $comment1->setApproved('1');
        $comment1->setPostId($manager->merge($this->getReference('post1')));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setAuthor('Маша');
        $comment2->setEmail('masha@example.com');
        $comment2->setUrl('');
        $comment2->setComment('Плиффетик ))) класна пишеш )))))))))))');
        $comment2->setIp('1270');
        $comment2->setApproved('1');
        $comment2->setPostId($manager->merge($this->getReference('post1')));
        $manager->persist($comment2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
