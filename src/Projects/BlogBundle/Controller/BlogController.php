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

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts(0, 10);

        $data = array(
            'mainTitle' => $this->mainTitle,
            'posts'     => $posts);

        return $this->render('ProjectsBlogBundle:Blog:index.html.twig', $data);
    }

    /**
     * Post page
     * 
     * @param string $slug Slug
     */
    public function postAction($slug)
    {
        $em = $this->getEm();

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException(sprintf('Not found'));
        }

        $mainTitle = $post->getTitle() . ' :: ' . $this->mainTitle;

        $data = array(
            'mainTitle' => $mainTitle,
            'title'     => $post->getTitle(),
            'description' => $post->getDescription(),
            'post' => $post->getPost(),
            'createdAt' => $post->getCreatedAt());

        return $this->render('ProjectsBlogBundle:Blog:post.html.twig', $data);
    }
}
