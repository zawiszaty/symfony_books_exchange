<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserAuthController
 *
 * @package AppBundle\Controller
 */
final class UserAuthController extends FOSRestController
{
    /**
     * Auth method
     *
     * @Rest\Post("/api/panel/auth")
     *
     * @return Response
     */
    public function auth(): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser();


        $view = $this->view(["userId" => $user->getId()], 200);

        return $this->handleView($view);
    }
}