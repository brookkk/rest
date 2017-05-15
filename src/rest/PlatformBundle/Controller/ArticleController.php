<?php

namespace rest\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use rest\PlatformBundle\Entity\Article;



class ArticleController extends Controller
{

 


    public function showAction()
    {

 	$article=new Article();

    	$article
    		->setTitle('My first Art')
    		->setContent('My first articles content')
    		;

    	$data=$this->get('jms_serializer')->serialize($article, 'json');

    	$response=new Response($data);
    	$response->headers->set('Content-Type', 'application/json');

        return $response;
    }




    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $article = $this->get('jms_serializer')->deserialize($data, 'PlatformBundle\Entity\Article', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }
}
