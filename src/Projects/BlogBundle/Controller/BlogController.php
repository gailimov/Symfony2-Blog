<?php

/**
 * Blog
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) 2011 Kanat Gailimov, (http://gailimov.info)
 */


namespace Projects\BlogBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Projects\BlogBundle\Entity\Comment;

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
        $em = $this->init();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts(0, 10);

        $data = array(
            'mainTitle'   => $this->title,
            'title'       => $this->title,
            'description' => $this->description,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'links'       => $this->links,
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
        $em = $this->init();

        // Error message
        $error = null;
        // Form field values
        $commentAuthor  = null;
        $commentEmail   = null;
        $commentUrl     = null;
        $commentContent = null;

        // Handling of comments
        // TODO: Прикрутить Symfony2 валидацию
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            // If the comment is valid - add it
            if ($this->isCommentValid($request)) {
                $this->addComment($em, $request);
                return $this->redirect($this->generateUrl('post', array('slug' => $slug)));
            // ...otherwise - displaying errors
            } else {
                $error          = 'Пожалуйста, заполните поля правильно.';
                $commentAuthor  = $request->request->get('cauthor');
                $commentEmail   = $request->request->get('cemail');
                $commentUrl     = $request->request->get('curl');
                $commentContent = $request->request->get('ccomment');
            }
        }

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        $comments = $em->getRepository('ProjectsBlogBundle:Comment')->getByPostId($post->getId());

        $mainTitle = $post->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'      => $mainTitle,
            'title'          => $this->title,
            'pages'          => $this->pages,
            'categories'     => $this->categories,
            'links'          => $this->links,
            'description'    => $post->getDescription(),
            'post'           => $post,
            'comments'       => $comments,
            'error'          => $error,
            'commentAuthor'  => $commentAuthor,
            'commentEmail'   => $commentEmail,
            'commentUrl'     => $commentUrl,
            'commentContent' => $commentContent);

        return $this->render('ProjectsBlogBundle:Blog:post.html.twig', $data);
    }

    /**
     * Posts by category page
     * 
     * @param string $slug Slug
     */
    public function categoryAction($slug)
    {
        $em = $this->init();

        $category = $em->getRepository('ProjectsBlogBundle:Category')->getBySlug($slug);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $categoryId = $category->getId();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getPostByCategoryId($categoryId);

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
            'links'       => $this->links,
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
        $em = $this->init();

        $author = $em->getRepository('ProjectsBlogBundle:User')->getByUsername($author);

        if (!$author) {
            throw new NotFoundHttpException('Author not found');
        }

        $userId = $author->getId();

        $posts = $em->getRepository('ProjectsBlogBundle:Post')->getPostByUserId($userId);

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $mainTitle = $author->getUsername() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'description' => $this->description,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'links'       => $this->links,
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
        $em = $this->init();

        $page = $em->getRepository('ProjectsBlogBundle:Post')->getPageBySlug($slug);

        if (!$page) {
            throw new NotFoundHttpException('Not found');
        }

        $mainTitle = $page->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'links'       => $this->links,
            'description' => $page->getDescription(),
            'page'        => $page);

        return $this->render('ProjectsBlogBundle:Blog:page.html.twig', $data);
    }

    /**
     * Comment form validator
     * 
     * @param  object  $request Request
     * @return boolean          true on success, false on fail
     */
    private function isCommentValid($request)
    {
        $author         = $request->request->get('cauthor');
        $email          = $request->request->get('cemail');
        $commentContent = $request->request->get('ccomment');

        if (!empty($author) && !empty($email) && !empty($commentContent)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Add comment
     * 
     * @param  object  $em      \Doctrine\ORM\EntityManager
     * @param  object  $request Request
     * @return boolean
     */
    private function addComment($em, $request)
    {
        $postId         = $request->request->get('postId');
        $author         = $request->request->get('cauthor');
        $email          = $request->request->get('cemail');
        $url            = $request->request->get('curl');
        $commentContent = $request->request->get('ccomment');
        $fakeEmail      = $request->request->get('email');

        // Antispam :)
        if (!empty($fakeEmail)) {
            die('Spam detected');
        }

        if ($author == 'Представьтесь *') {
            $author = '';
        }
        if ($email == 'Email *') {
            $email = '';
        }
        if ($url == 'URL') {
            $url = '';
        }

        if ($this->commentsModerated == 0) {
            $approved = 1;
        } else {
            $approved = 0;
        }

        $comment = new Comment();
        $comment->setPostId($em->getReference('ProjectsBlogBundle:Post', $postId))
                ->setAuthor($author)
                ->setEmail($email)
                ->setUrl($url)
                ->setComment($commentContent)
                ->setIp($request->getClientIp())
                ->setUserAgent($request->server->get('HTTP_USER_AGENT'))
                ->setApproved($approved);

        $em->persist($comment);
        $em->flush();

        return true;
    }
}
