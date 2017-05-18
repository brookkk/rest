<?php

namespace rest\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatController extends Controller
{
    public function indexAction()
    {
        return $this->render('restUserBundle:Default:index.html.twig');
    }

    public function chatAction()
    {
        return $this->render('restUserBundle:Chat:chat.html.twig');
    }
}
