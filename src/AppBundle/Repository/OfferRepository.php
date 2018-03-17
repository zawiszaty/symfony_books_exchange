<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Offer;
use Doctrine\ORM\EntityRepository;

final class OfferRepository extends EntityRepository
{
    public function save(Offer $offer): void
    {
        $this->getEntityManager()->persist($offer);
        $this->getEntityManager()->flush();
    }

    public function accepted(string $offerId, string $userId): void
    {
        $offer = $this->find($offerId);
        if ($offer->getRequiredUser()->getId() != $userId
            || $offer->isAccepted() == 1
            || $offer->isRejected() == 1
        ) {
            throw new \Exception();
        }
        $offer->acceptedOffer();

        $this->getEntityManager()->flush();
    }

    public function rejected(string $offerId, string $userId): void
    {
        $offer = $this->find($offerId);
        if (
            $offer->getRequiredUser()->getId() != $userId
            || $offer->isAccepted() == 1
            || $offer->isRejected() == 1
        ) {
            throw new \Exception();
        }
        $offer->rejectedOffer();

        $this->getEntityManager()->flush();
    }

    public function seen(array $idoffer): void
    {
        foreach ($idoffer as $item) {
            $offer = $this->find($item);
            $offer->seenOffer();

        }
        $this->getEntityManager()->flush();
    }

}