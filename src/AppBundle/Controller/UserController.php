<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserAuthController
 *
 * @package AppBundle\Controller
 */
final class UserController extends FOSRestController
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

    /**
     * @param Request $request
     *
     * @Rest\Post("/api/register")
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $data = [
            "email" => $request->request->get('email'),
            "username" => $request->request->get('username'),
            "plainPassword" => [
                "first" => $request->request->get('plainPassword')['first'],
                "second" => $request->request->get('plainPassword')['second']
            ]
        ];
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->submit($data);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                $view = $this->view('success', 200);

                return $this->handleView($view);
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        $view = $this->view($form->getErrors(), 200);

        return $this->handleView($view);
    }

}