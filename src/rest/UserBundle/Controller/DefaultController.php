<?php

namespace rest\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('restUserBundle:Default:index.html.twig');
    }
}
