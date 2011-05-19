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

        $this->data['posts'] = $this->createPaginator($em->getRepository('ProjectsBlogBundle:Post')->getAllPosts(),
                                                      $em->getRepository('ProjectsBlogBundle:Post')->countAllPosts());

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $this->data);
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
        // Cookies
        if (isset($_COOKIE['sfb_commentAuthor'])) {
            $commentAuthorCookie = $_COOKIE['sfb_commentAuthor'];
        } else {
            $commentAuthorCookie = null;
        }
        if (isset($_COOKIE['sfb_commentEmail'])) {
            $commentEmailCookie = $_COOKIE['sfb_commentEmail'];
        } else {
            $commentEmailCookie = null;
        }
        if (isset($_COOKIE['sfb_commentUrl'])) {
            $commentUrlCookie = $_COOKIE['sfb_commentUrl'];
        } else {
            $commentUrlCookie = null;
        }

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        // Handling of comments
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $comment = new Comment();
            $comment->setAuthor(htmlspecialchars(trim($request->request->get('cauthor'))))
                    ->setEmail(htmlspecialchars(trim($request->request->get('cemail'))))
                    ->setComment(nl2br(htmlspecialchars($request->request->get('ccomment'))));

            $errors = $this->container->get('validator')->validate($comment);

            // Getting admin email
            $admin      = $em->getRepository('ProjectsBlogBundle:User')->getAdmin();
            $adminEmail = $admin->getEmail();

            // Preparing comment data
            $commentData = array('post'    => $post->getTitle(),
                                 'author'  => trim($request->request->get('cauthor')),
                                 'comment' => nl2br(htmlspecialchars($request->request->get('ccomment'))),
                                 'link'    => $this->url . '/post/' . $slug . '/');

            // If the comment is valid - add it
            if (count($errors) === 0) {
                $this->addComment($post->getId(), $em, $request, $comment);

                // Setting the cookie
                $expire = time() + 3600 * 24 * 365;
                $path = '/';
                setcookie('sfb_commentAuthor', $request->request->get('cauthor'), $expire, $path);
                setcookie('sfb_commentEmail',  $request->request->get('cemail'),  $expire, $path);
                setcookie('sfb_commentUrl',    $request->request->get('curl'),    $expire, $path);

                // Sending mail to admin about new comment
                $this->sendMailToAdmin($this->title, $this->url, $adminEmail, $commentData);

                return $this->redirect($this->generateUrl('post', array('slug' => $slug)));
            }
        }

        $this->data['mainTitle']           = $post->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['description']         = $post->getDescription();
        $this->data['post']                = $post;
        $this->data['comments']            = $em->getRepository('ProjectsBlogBundle:Comment')->getByPostId($post->getId());
        $this->data['errors']              = $errors;
        $this->data['commentAuthorCookie'] = $commentAuthorCookie;
        $this->data['commentEmailCookie']  = $commentEmailCookie;
        $this->data['commentUrlCookie']    = $commentUrlCookie;

        return $this->render('ProjectsBlogBundle:Blog:post.html.twig', $this->data);
    }

    /**
     * Posts by category page
     * 
     * @param string $slug Slug
     */
    public function categoryAction($slug = '')
    {
        $em = $this->init();

        // If the category is not listed - we derive the entire list
        if (empty($slug)) {
            return $this->render('ProjectsBlogBundle:Blog:categories.html.twig', $this->getListData('Все категории'));
        }

        $category = $em->getRepository('ProjectsBlogBundle:Category')->getBySlug($slug);

        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        $posts = $this->createPaginator($em->getRepository('ProjectsBlogBundle:Post')->getPostByCategoryId($category->getId()));

        // TODO: FIX THIS
        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $this->data['mainTitle']   = $category->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['description'] = $category->getDescription();
        $this->data['posts']       = $posts;

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $this->data);
    }

    /**
     * Posts by author page
     * 
     * @param string $author Author
     */
    public function authorAction($author = '')
    {
        $em = $this->init();

        // If the author is not listed - we derive the entire list
        if (empty($author)) {
            $authors = $em->getRepository('ProjectsBlogBundle:User')->findAll();
            return $this->render('ProjectsBlogBundle:Blog:authors.html.twig', $this->getListData('Все авторы', $authors));
        }

        $author = $em->getRepository('ProjectsBlogBundle:User')->getByUsername($author);

        if (!$author) {
            throw new NotFoundHttpException('Author not found');
        }

        $posts = $this->createPaginator($em->getRepository('ProjectsBlogBundle:Post')->getPostByUserId($author->getId()));

        if (!$posts) {
            throw new NotFoundHttpException('Posts not found');
        }

        $this->data['mainTitle'] = $author->getUsername() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['posts']     = $posts;

        return $this->render('ProjectsBlogBundle:Blog:posts.html.twig', $this->data);
    }

    /**
     * View page
     * 
     * @param string $slug Slug
     */
    public function pageAction($slug = '')
    {
        $em = $this->init();

        // If the page is not listed - we derive the entire list
        if (empty($slug)) {
            return $this->render('ProjectsBlogBundle:Blog:pages.html.twig', $this->getListData('Все страницы'));
        }

        $page = $em->getRepository('ProjectsBlogBundle:Post')->getPageBySlug($slug);

        if (!$page) {
            throw new NotFoundHttpException('Not found');
        }

        $this->data['mainTitle']   = $page->getTitle() . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['description'] = $page->getDescription();
        $this->data['page']        = $page;

        return $this->render('ProjectsBlogBundle:Blog:page.html.twig', $this->data);
    }

    /**
     * RSS-feed of posts
     */
    public function feedAction()
    {
        $em = $this->init();

        $admin = $em->getRepository('ProjectsBlogBundle:User')->getAdmin();

        $this->data['posts'] = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts()
                                                                            ->setMaxResults(10)
                                                                            ->getResult();
        $this->data['email'] = $admin->getEmail();
        $this->data['name']  = $admin->getFirstname();

        return $this->render('ProjectsBlogBundle:Blog:feed.xml.twig', $this->data);
    }

    /**
     * RSS-feed of comments
     */
    public function commentsFeedAction()
    {
        $em = $this->init();

        $admin = $em->getRepository('ProjectsBlogBundle:User')->getAdmin();

        $this->data['mainTitle'] = 'RSS-лента комментариев ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['email']     = $admin->getEmail();
        $this->data['name']      = $admin->getFirstname();
        $this->data['posts']     = $em->getRepository('ProjectsBlogBundle:Post')
                                      ->getAllPosts()
                                      ->getResult();
        $this->data['comments']  = $em->getRepository('ProjectsBlogBundle:Comment')
                                      ->getAllApproved('10');

        return $this->render('ProjectsBlogBundle:Blog:commentsFeed.xml.twig', $this->data);
    }

    /**
     * RSS-feed of comments to post
     * 
     * @param string $slug Post's slug
     */
    public function commentsToPostFeedAction($slug)
    {
        $em = $this->init();

        $admin = $em->getRepository('ProjectsBlogBundle:User')->getAdmin();

        $post = $em->getRepository('ProjectsBlogBundle:Post')->getPostBySlug($slug);

        if (!$post) {
            throw new NotFoundHttpException('Not found');
        }

        $this->data['slug']        = $slug;
        $this->data['mainTitle']   = 'RSS-лента комментариев к посту &laquo;' . $post->getTitle() . '&raquo; ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['description'] = 'RSS-лента комментариев к посту &laquo;' . $post->getTitle() . '&raquo';
        $this->data['email']       = $admin->getEmail();
        $this->data['name']        = $admin->getFirstname();
        $this->data['comments']    = $em->getRepository('ProjectsBlogBundle:Comment')->getByPostId($post->getId());

        return $this->render('ProjectsBlogBundle:Blog:commentsToPostFeed.xml.twig', $this->data);
    }

    /**
     * HTML sitemap
     */
    public function htmlSitemapAction()
    {
        $em = $this->init();

        $this->data['posts'] = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts()
                                                                            ->getResult();

        return $this->render('ProjectsBlogBundle:Blog:sitemap.html.twig', $this->data);
    }

    /**
     * XML sitemap
     */
    public function xmlSitemapAction()
    {
        $em = $this->init();

        $this->data['posts'] = $em->getRepository('ProjectsBlogBundle:Post')->getAllPosts()
                                                                            ->getResult();

        return $this->render('ProjectsBlogBundle:Blog:sitemap.xml.twig', $this->data);
    }

    /**
     * Get data for list
     * 
     * @param  string $mainTitle Title
     * @param  array  $authors   Array of authors
     * @return array
     */
    private function getListData($mainTitle, $authors = array())
    {
        $this->data['mainTitle'] = $mainTitle . ' ' . $this->config['titleSeparator'] . ' ' . $this->title;
        $this->data['authors']   = $authors;

        return $this->data;
    }

    /**
     * Add comment
     * 
     * @param  integer $postId  ID of post
     * @param  object  $em      \Doctrine\ORM\EntityManager
     * @param  object  $request Request
     * @param  object  $comment Projects\BlogBundle\Entity\Comment
     * @return boolean
     */
    private function addComment($postId, $em, $request, $comment)
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

        $comment->setPostId($em->getReference('ProjectsBlogBundle:Post', $postId))
                ->setUrl(htmlspecialchars(trim($request->request->get('curl'))))
                ->setIp(ip2long($request->getClientIp()))
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
