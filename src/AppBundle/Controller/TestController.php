<?php
/**
 * Created by PhpStorm.
 * User: zawisza
 * Date: 02.02.2018
 * Time: 15:15
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;

class TestController extends FOSRestController
{
    /**
     * @Get("/api/test")
     *
     * @return Response
     */
    public function test(): Response
    {
        $user = $this->getDoctrine()->getRepository(Category::class)->findAll();

//        $serializer = $this->get('jms_serializer');
//        $serializer->serialize($user, 'json');
        $view = $this->view($user, 200);
        return $this->handleView($view);
    }
}