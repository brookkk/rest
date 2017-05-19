<?php

namespace rest\PlatformBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use rest\PlatformBundle\Entity\Article;



class ArticleController extends Controller
{

 

 

 /**
     * @Get(
     *     path = "/articles/{id}",
     *     name = "article_show",
     *     requirements = {"id"="\d+"}
     *     
     * )
     * @View(
        * statusCode = 200
        * )
     */
    public function showAction(Article $article)
    {


/*
    	$data=$this->get('jms_serializer')->serialize($article, 'json');

    	$response=new Response($data);
    	$response->headers->set('Content-Type', 'application/json');

        return $response;*/

        return $article;
    }


/**
     * @Route("/articles", name="article_create")
     * @Method({"POST"})
     */

    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $article = $this->get('jms_serializer')->deserialize($data, 'rest\PlatformBundle\Entity\Article', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

/**
	     * @Route("/articles", name="listeArticles")
     * @Method({"GET"})
     */

/**
     * @Get(
     *     path = "/articles",
     *     name = "articles_show",
     * )
     * @View
     */

	public function listeArticlesAction()
    {
    	

 /*      // THE OLD WAY / SERIALIZOR AND STUFF


   $listeArticles = $this  ->getDoctrine()   ->getRepository('restPlatformBundle:Article')->findAll();


    $data=$this->get('jms_serializer')->serialize($listeArticles, 'json');

        $response=new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
*/


        // the better way : using FosRestBundle

    $listeArticles = $this  ->getDoctrine()   ->getRepository('restPlatformBundle:Article')->findAll();


     return $listeArticles;


    }

}
