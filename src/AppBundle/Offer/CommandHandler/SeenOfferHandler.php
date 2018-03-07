<?php


namespace AppBundle\Offer\CommandHandler;


use AppBundle\Offer\Command\SeenOfferCommand;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\OfferRepository;

final class SeenOfferHandler
{
    private $offerRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function handle(
        SeenOfferCommand $seenOfferCommand
    ): void
    {
        $this->offerRepository->seen($seenOfferCommand->getIdoffer());
    }
}