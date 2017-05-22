<?php

namespace rest\PlatformBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use rest\PlatformBundle\Entity\Article;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use FOS\RestBundle\Request\ParamFetcherInterface;



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
     * @Rest\Post(
     *    path = "/articles",
     *    name = "article_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("article", converter="fos_rest.request_body")
     */

    public function createAction(Article $article)
    {
       
/*
        $data = $request->getContent();
        $article = $this->get('jms_serializer')->deserialize($data, 'rest\PlatformBundle\Entity\Article', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);

        */



         $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();

        //return $this->view($article, Response::HTTP_CREATED, ['Location' => $this->generateUrl('article_create', ['id' => $article->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);

        return $article;


    }

 





    /**
     * @Rest\Get("/articles", name="articles_show")
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]",
     *     nullable=true,
     *     default="title",
     *     description="The keyword to search for."
    * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="15",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     * @Rest\View()
     */


	public function listeArticlesAction(ParamFetcherInterface $paramFetcher)
    {
    
    // with pager	

    $pager = $this->getDoctrine()->getRepository('restPlatformBundle:Article')->search(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );

        return $pager->getCurrentPageResults();




 


        // the better way : using FosRestBundle
/*  $listeArticles = $this  ->getDoctrine()   ->getRepository('restPlatformBundle:Article')->findAll();


     return $listeArticles;
*/

    }

}
