<?php


namespace AppBundle\Offer\CommandHandler;


use AppBundle\Entity\Offer;
use AppBundle\Offer\Command\AddOfferCommand;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\OfferRepository;
use AppBundle\Repository\UserRepository;

final class AddOfferHandler
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

    public function handle(AddOfferCommand $addOfferCommand): void
    {
        $bookOffered = $this->bookRepository
            ->find($addOfferCommand->getOfferedBook());

        $bookRequired = $this->bookRepository
            ->find($addOfferCommand->getRequiredBook());

        $offeredUser = $this->userRepository
            ->find($addOfferCommand->getOfferedUser());

        $requiredUser = $this->userRepository
            ->find($addOfferCommand->getRequiredUser());

        $offer = new Offer(
            $addOfferCommand->getDescription(),
            $bookOffered,
            $bookRequired,
            $offeredUser,
            $requiredUser,
            0,
            0,
            0
        );
        $offer->setCreated();

        $this->offerRepository->save($offer);
    }
}