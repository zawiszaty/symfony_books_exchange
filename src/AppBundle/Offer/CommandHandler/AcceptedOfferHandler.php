<?php


namespace AppBundle\Offer\CommandHandler;


use AppBundle\Offer\Command\AcceptedOfferCommand;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\OfferRepository;
use AppBundle\Repository\UserRepository;

final class AcceptedOfferHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    private $offerRepository;
    private $userRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $bookRepository, OfferRepository $offerRepository, UserRepository $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->offerRepository = $offerRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(
        AcceptedOfferCommand $acceptedOfferCommand
    ): void
    {
        $this->offerRepository->accepted($acceptedOfferCommand->getIdOffer(), $acceptedOfferCommand->getRequiredUser());
    }
}