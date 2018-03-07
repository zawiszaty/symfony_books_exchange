<?php


namespace AppBundle\Offer\Query;


interface OfferQuery
{
    public function getUserAcceptedOffer(string $userId): array ;
    public function getNewOffer(string $userId): array;
}