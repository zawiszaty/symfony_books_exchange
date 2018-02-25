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
}