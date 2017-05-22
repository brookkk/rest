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
use Symfony\Component\Validator\ConstraintViolationList;



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

        //amazingly easy :3
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

    public function createAction(Article $article, ConstraintViolationList $violations)
    {
       


      /*  $errors = $this->get('validator')->validate($article);

        if (count($errors)) {
            return $this->view($errors, Response::HTTP_BAD_REQUEST);
        }*/

 if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

         $em = $this->getDoctrine()->getManager();

        $em->persist($article);
        $em->flush();


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

/*    $pager = $this->getDoctrine()->getRepository('restPlatformBundle:Article')->search(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );

        return $pager->getCurrentPageResults();

*/


 


        // the better way : using FosRestBundle
  $listeArticles = $this  ->getDoctrine()   ->getRepository('restPlatformBundle:Article')->findAll();


     return $listeArticles;


    }

}
