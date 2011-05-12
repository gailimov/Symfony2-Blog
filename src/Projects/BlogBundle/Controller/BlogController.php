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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Home page
     */
    public function indexAction()
    {
        $em = $this->getEm();

        $pages      = $em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $categories = $em->getRepository('ProjectsBlogBundle:Category')->getAll();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts(0, 10);

        $data = array(
            'mainTitle'   => $this->mainTitle,
            'description' => $this->description,
            'pages'       => $pages,
            'categories'  => $categories,
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
        $em = $this->getEm();

        $pages      = $em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $categories = $em->getRepository('ProjectsBlogBundle:Category')->getAll();

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        $mainTitle = $post->getTitle() . ' :: ' . $this->mainTitle;

        $data = array(
            'mainTitle'      => $mainTitle,
            'pages'          => $pages,
            'categories'     => $categories,
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
        $em = $this->getEm();

        $pages      = $em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $categories = $em->getRepository('ProjectsBlogBundle:Category')->getAll();

        $category = $em->getRepository('ProjectsBlogBundle:Category')->getBySlug($slug);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $categoryId = $category->getId();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getPostByCategoryId($categoryId);

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $mainTitle = $category->getTitle() . ' :: ' . $this->mainTitle;

        $data = array(
            'mainTitle'   => $mainTitle,
            'description' => $category->getDescription(),
            'pages'       => $pages,
            'categories'  => $categories,
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
        $em = $this->getEm();

        $pages      = $em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $categories = $em->getRepository('ProjectsBlogBundle:Category')->getAll();

        $author = $em->getRepository('ProjectsBlogBundle:User')->getByUsername($author);

        if (!$author) {
            throw new NotFoundHttpException('Author not found');
        }

        $userId = $author->getId();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getPostByUserId($userId);

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $mainTitle = $author->getUsername() . ' :: ' . $this->mainTitle;

        $data = array(
            'mainTitle'   => $mainTitle,
            'description' => $this->description,
            'pages'       => $pages,
            'categories'  => $categories,
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
        $em = $this->getEm();

        $pages      = $em->getRepository('ProjectsBlogBundle:Post')->getAllPages();
        $categories = $em->getRepository('ProjectsBlogBundle:Category')->getAll();

        $page = $em->getRepository('ProjectsBlogBundle:Post')->getPageBySlug($slug);

        if (!$page) {
            throw new NotFoundHttpException('Not found');
        }

        $mainTitle = $page->getTitle() . ' :: ' . $this->mainTitle;

        $data = array(
            'mainTitle'   => $mainTitle,
            'pages'       => $pages,
            'categories'  => $categories,
            'title'       => $page->getTitle(),
            'description' => $page->getDescription(),
            'post'        => $page->getPost());

        return $this->render('ProjectsBlogBundle:Blog:page.html.twig', $data);
    }
}
