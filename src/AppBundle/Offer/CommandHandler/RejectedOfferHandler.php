<?php


namespace AppBundle\Offer\CommandHandler;


use AppBundle\Offer\Command\AcceptedOfferCommand;
use AppBundle\Offer\Command\RejectedOfferCommand;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\OfferRepository;
use AppBundle\Repository\UserRepository;

final class RejectedOfferHandler
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
        RejectedOfferCommand $rejectedOfferCommand
    ): void
    {
        $this->offerRepository->rejected($rejectedOfferCommand->getIdOffer(), $rejectedOfferCommand->getRequiredUser());
    }
}