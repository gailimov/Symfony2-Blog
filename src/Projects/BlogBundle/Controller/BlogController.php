<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Blog controller
 */
class BlogController extends BaseController
{
    /**
     * Home page
     */
    public function indexAction()
    {
        parent::init();

        $posts = $this->em->getRepository('ProjectsBlogBundle:Post')->getAllPosts(0, 10);

        $data = array(
            'mainTitle'   => $this->title,
            'title'       => $this->title,
            'description' => $this->description,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'posts'       => $posts);

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $data);
    }

    /**
     * Post page
     * 
     * @param string $slug Slug
     */
    public function postAction($slug)
    {
        parent::init();

        $post = $this->em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        $mainTitle = $post->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'      => $mainTitle,
            'title'          => $this->title,
            'pages'          => $this->pages,
            'categories'     => $this->categories,
            'postTitle'      => $post->getTitle(),
            'description'    => $post->getDescription(),
            'postCategoryId' => $post->getCategoryId(),
            'postUserId'     => $post->getUserId(),
            'post'           => $post->getPost(),
            'createdAt'      => $post->getCreatedAt());

        return $this->render('ProjectsBlogBundle:Blog:post.html.twig', $data);
    }

    /**
     * Posts by category page
     * 
     * @param string $slug Slug
     */
    public function categoryAction($slug)
    {
        parent::init();

        $category = $this->em->getRepository('ProjectsBlogBundle:Category')->getBySlug($slug);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $categoryId = $category->getId();

        $posts = $this->em->getRepository('ProjectsBlogBundle:Post')->getPostByCategoryId($categoryId);

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $mainTitle = $category->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'description' => $category->getDescription(),
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'posts'       => $posts);

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $data);
    }

    /**
     * Posts by author page
     * 
     * @param string $author Author
     */
    public function authorAction($author)
    {
        parent::init();

        $author = $this->em->getRepository('ProjectsBlogBundle:User')->getByUsername($author);

        if (!$author) {
            throw new NotFoundHttpException('Author not found');
        }

        $userId = $author->getId();

        $posts = $this->em->getRepository('ProjectsBlogBundle:Post')->getPostByUserId($userId);

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $mainTitle = $author->getUsername() . ' :: ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'description' => $this->description,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'posts'       => $posts);

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $data);
    }

    /**
     * View page
     * 
     * @param string $slug Slug
     */
    public function pageAction($slug)
    {
        parent::init();

        $page = $this->em->getRepository('ProjectsBlogBundle:Post')->getPageBySlug($slug);

        if (!$page) {
            throw new NotFoundHttpException('Not found');
        }

        $mainTitle = $page->getTitle() . ' :: ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'pageTitle'   => $page->getTitle(),
            'description' => $page->getDescription(),
            'post'        => $page->getPost());

        return $this->render('ProjectsBlogBundle:Blog:page.html.twig', $data);
    }
}
