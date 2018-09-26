<?php
/**
 * Created by PhpStorm.
 * User: dodji
 * Date: 26/09/18
 * Time: 05:41
 */

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
///use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends Controller
{
    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function showAction(Article $article)
    {
        $data = $this->get('jms_serializer')->serialize($article, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**

     * @Route("/articles", name="article_create")

     * @Method({"POST"})

     */

    public function createAction(Request $request)

    {

        $data = $request->getContent();

        $article = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Article', 'json');


        $em = $this->getDoctrine()->getManager();

        $em->persist($article);

        $em->flush();


        return new Response('', Response::HTTP_CREATED);

    }

    /**
     * @Route("/articles_liste", name="article_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $articles = $this->getDoctrine()->getRepository('App:Article')->findAll();
        $data = $this->get('jms_serializer')->serialize($articles, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}