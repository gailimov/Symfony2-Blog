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
        $errors = array();

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        $comments = $em->getRepository('ProjectsBlogBundle:Comment')->getByPostId($post->getId());

        // Handling of comments
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $comment = new Comment;
            $comment->setAuthor($request->request->get('cauthor'))
                    ->setEmail($request->request->get('cemail'))
                    ->setComment($request->request->get('ccomment'));

            $errors = $this->container->get('validator')->validate($comment);

            // Getting admin email
            $admin      = $em->getRepository('ProjectsBlogBundle:User')->getAdmin();
            $adminEmail = $admin->getEmail();

            // Preparing comment data
            $commentData = array('post'    => $post->getTitle(),
                                 'author'  => $request->request->get('cauthor'),
                                 'comment' => nl2br($request->request->get('ccomment')),
                                 'link'    => $this->url . '/post/' . $slug . '/');

            // If the comment is valid - add it
            if (count($errors) === 0) {
                $this->addComment($em, $request, $comment);
                // Sending mail to admin about new comment
                $this->sendMailToAdmin($this->title, $this->url, $adminEmail, $commentData);
                return $this->redirect($this->generateUrl('post', array('slug' => $slug)));
            }
        }

        $mainTitle = $post->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;

        $data = array(
            'mainTitle'   => $mainTitle,
            'title'       => $this->title,
            'pages'       => $this->pages,
            'categories'  => $this->categories,
            'links'       => $this->links,
            'description' => $post->getDescription(),
            'post'        => $post,
            'comments'    => $comments,
            'errors'      => $errors);

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
     * Add comment
     * 
     * @param  object  $em      \Doctrine\ORM\EntityManager
     * @param  object  $request Request
     * @param  object  $comment Projects\BlogBundle\Entity\Comment
     * @return boolean
     */
    private function addComment($em, $request, $comment)
    {
        $fakeEmail = $request->request->get('email');

        // Antispam :)
        if (!empty($fakeEmail)) {
            die('Spam detected');
        }

        if ($this->commentsModerated == 0) {
            $approved = 1;
        } else {
            $approved = 0;
        }

        $comment->setPostId($em->getReference('ProjectsBlogBundle:Post', $request->request->get('postId')))
                ->setUrl($request->request->get('curl'))
                ->setIp($request->getClientIp())
                ->setUserAgent($request->server->get('HTTP_USER_AGENT'))
                ->setApproved($approved);

        $em->persist($comment);
        $em->flush();

        return true;
    }

    /**
     * Send mail to admin about new comment
     * 
     * @param  string  $blogTitle  Blog title
     * @param  string  $blogUrl    Blog URL
     * @param  string  $adminEmail Admin's email
     * @param  array   $data       Array of comment data
     * @return boolean
     */
    private function sendMailToAdmin($blogTitle, $blogUrl, $adminEmail, $data)
    {
        $blogUrl = str_replace('http://', '', $blogUrl);

        $mailer = $this->get('mailer');

        $message = \Swift_Message::newInstance()->setSubject('Новый комментарий на блоге «' . $blogTitle . '»')
                                                ->setFrom('noreply@' . $blogUrl)
                                                ->setTo($adminEmail)
                                                ->setBody($this->renderView('ProjectsBlogBundle:Blog:mail.html.twig', $data), 'text/html')
                                                ->addPart($this->renderView('ProjectsBlogBundle:Blog:mail.txt.twig',  $data), 'text/plain');

        $mailer->send($message);

        return true;
    }
}
