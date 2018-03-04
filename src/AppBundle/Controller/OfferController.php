<?php

namespace AppBundle\Controller;

use AppBundle\Book\Command\DeleteBookCommand;
use AppBundle\Form\AcceptedOfferForm;
use AppBundle\Form\AddOfferForm;
use AppBundle\Form\RejectedOfferForm;
use AppBundle\Offer\Command\AcceptedOfferCommand;
use AppBundle\Offer\Command\AddOfferCommand;
use AppBundle\Offer\Command\RejectedOfferCommand;
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
     * @Rest\Get("/api/get/accepted/offer/{id}")
     */
    public function getUserAcceptedOffer(Request $request, string $id): Response
    {
        $offerQuery = $this->get('appbundle\offer\queryview\offerview');
        $view = $this->view($offerQuery->getUserAcceptedOffer($id), 200);
        return $this->handleView($view);
    }

    /**
     * This method return all user accepted offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Get("/api/get/requested/offer/{id}")
     */
    public function getUserRequestedOffer(Request $request, string $id): Response
    {
        $offerQuery = $this->get('appbundle\offer\queryview\offerview');
        $view = $this->view($offerQuery->getRequestedUserOffer($id), 200);
        return $this->handleView($view);
    }

    /**
     * This method add new Offer
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Put("/api/add/offer")
     */
    public function newOffer(Request $request): Response
    {
        $data = [
            'description' => $request->request->get('description'),
            'offeredBook' => $request->request->get('offeredBook'),
            'requiredBook' => $request->request->get('requiredBook'),
            'offeredUser' => $request->request->get('offeredUser'),
            'requiredUser' => $request->request->get('requiredUser'),
        ];
        $addOffer = new AddOfferCommand(
            $data['description'],
            $data['offeredBook'],
            $data['requiredBook'],
            $data['offeredUser'],
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
    public function acceptedOffer(Request $request)
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
    public function rejectedOffer(Request $request)
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
}