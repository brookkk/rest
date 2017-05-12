<?php

namespace rest\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('restPlatformBundle:Default:index.html.twig');
    }
}
