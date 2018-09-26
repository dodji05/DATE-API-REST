<?php
/**
 * Created by PhpStorm.
 * User: AFRIQIYA
 * Date: 26/09/2018
 * Time: 16:33
 */

namespace App\Controller;


use App\Entity\Author;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("/authors/{id}", name="author_show")
     */
    public function showAction()
    {
        $article = $this->getDoctrine()->getRepository('App:Article')->findOneById(1);

        $author = new Author();
        $author->setFullname('Sarah Khalil');
        $author->setBiography('Ma super biographie.');
        $author->getArticles()->add($article);


        $data =  $this->get('serializer')->serialize($author, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}