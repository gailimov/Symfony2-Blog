<?php

namespace Projects\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectsBlogBundle:Default:index.html.twig');
    }
}
