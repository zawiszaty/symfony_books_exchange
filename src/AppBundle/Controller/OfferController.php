<?php

namespace AppBundle\Controller;

use AppBundle\Book\Command\DeleteBookCommand;
use AppBundle\Form\AcceptedOfferForm;
use AppBundle\Form\AddOfferForm;
use AppBundle\Form\RejectedOfferForm;
use AppBundle\Form\SeenOfferForm;
use AppBundle\Offer\Command\AcceptedOfferCommand;
use AppBundle\Offer\Command\AddOfferCommand;
use AppBundle\Offer\Command\RejectedOfferCommand;
use AppBundle\Offer\Command\SeenOfferCommand;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class OfferController extends FOSRestController
{

    /**
     * This method return all user accepted offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Get("/api/panel/get/accepted/offer")
     */
    public function getUserAcceptedOffer(Request $request): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();

        $offerQuery = $this->get('appbundle\offer\queryview\offerview');
        $view = $this->view($offerQuery->getUserAcceptedOffer($user), 200);
        return $this->handleView($view);
    }

    /**
     * This method return all user accepted offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Get("/api/panel/get/new/user/offer")
     */
    public function getNewOffer(Request $request): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();

        $offerQuery = $this->get('appbundle\offer\queryview\offerview');
        $view = $this->view($offerQuery->getNewOffer($user), 200);
        return $this->handleView($view);
    }

    /**
     * This method add new Offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Put("/api/panel/add/offer")
     */
    public function newOffer(Request $request): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();
        $data = [
            'description' => $request->request->get('description'),
            'offeredBook' => $request->request->get('offeredBook'),
            'requiredBook' => $request->request->get('requiredBook'),
            'offeredUser' => $user,
            'requiredUser' => $request->request->get('requiredUser'),
        ];
        $addOffer = new AddOfferCommand(
            $data['description'],
            $data['offeredBook'],
            $data['requiredBook'],
            $user,
            $data['requiredUser']
        );

        $form = $this->createForm(AddOfferForm::class, $addOffer);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $addOffer
            );

            $deleteCommand = new DeleteBookCommand($addOffer->getRequiredBook());
            $this->get('command_bus')->handle(
                $deleteCommand
            );

            $deleteCommand = new DeleteBookCommand($addOffer->getOfferedBook());
            $this->get('command_bus')->handle(
                $deleteCommand
            );

            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method accepted Offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Post("/api/panel/accepted/offer")
     */
    public function acceptedOffer(Request $request): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();
        $data = [
            'idoffer' => $request->request->get('idoffer'),
            'requiredUser' => $user
        ];
        $acceptedCommand = new AcceptedOfferCommand(
            $data['idoffer'],
            $user
        );

        $form = $this->createForm(AcceptedOfferForm::class, $acceptedCommand);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle($acceptedCommand);
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method accepted Offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Post("/api/panel/rejected/offer")
     */
    public function rejectedOffer(Request $request): Response
    {
        $user = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();
        $data = [
            'idoffer' => $request->request->get('idoffer'),
            'requiredUser' => $user
        ];
        $rejectedCommand = new RejectedOfferCommand(
            $data['idoffer'],
            $user
        );

        $form = $this->createForm(RejectedOfferForm::class, $rejectedCommand);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle($rejectedCommand);
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method accepted Offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Post("/api/panel/seen/offer")
     */
    public function seenOffer(Request $request): Response
    {
        $data = [
            'idoffer' => $request->request->get('idoffer'),
        ];

        $seenOffer = new SeenOfferCommand($data['idoffer']);

        $form = $this->createForm(SeenOfferForm::class, $seenOffer);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle($seenOffer);
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);

    }
}