<?php


namespace AppBundle\Offer\Query;


interface OfferQuery
{
    public function getUserAcceptedOffer(string $userId): array ;
    public function getRequestedUserOffer(string $userId): array;
}