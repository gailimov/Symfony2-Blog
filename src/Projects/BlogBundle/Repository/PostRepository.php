<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    /**
     * Get all posts
     * 
     * @return Doctrine\ORM\Query
     */
    public function getAllPosts()
    {
        $query = "SELECT p
                  FROM ProjectsBlogBundle:Post p
                  WHERE p.postType = 'post'
                  ORDER BY p.createdAt DESC, p.id DESC";

        return $this->getEntityManager()->createQuery($query);
    }

    /**
     * Get post by ID of category
     * 
     * @param  integer $categoryId ID of category
     * @return Doctrine\ORM\Query
     */
    public function getPostByCategoryId($categoryId)
    {                  
        $query = "SELECT p
                  FROM ProjectsBlogBundle:Post p
                  WHERE p.postType = 'post' AND p.categoryId = ?1
                  ORDER BY p.createdAt DESC, p.id DESC";

        try {
            return $this->getEntityManager()->createQuery($query)
                                            ->setParameter(1, $categoryId);
        } catch(NoResultException $e) {
            return null;
        }
    }

    /**
     * Get post by ID of user
     * 
     * @param  integer $userId ID of user
     * @return Doctrine\ORM\Query
     */
    public function getPostByUserId($userId)
    {                  
        $query = "SELECT p
                  FROM ProjectsBlogBundle:Post p
                  WHERE p.postType = 'post' AND p.userId = ?1
                  ORDER BY p.createdAt DESC, p.id DESC";

        try {
            return $this->getEntityManager()->createQuery($query)
                                            ->setParameter(1, $userId);
        } catch(NoResultException $e) {
            return null;
        }
    }

    /**
     * Count all posts
     * 
     * @return integer
     */
    public function countAllPosts()
    {
        $query = "SELECT COUNT(p)
                  FROM ProjectsBlogBundle:Post p
                  WHERE p.postType = 'post'";

        return $this->getEntityManager()->createQuery($query)
                                        ->getSingleScalarResult();
    }
}
