<?php

namespace AppBundle\Offer\Command;


class RejectedOfferCommand
{
    /*
     * var string
     */
    public $idoffer;

    public $requiredUser;

    /**
     * AccpetedOfferCommand constructor.
     *
     * @param string $idOffer
     */
    public function __construct(string $idOffer, string $requiredUser)
    {
        $this->idoffer = $idOffer;
        $this->requiredUser = $requiredUser;
    }

    /**
     * @return string
     */
    public function getIdOffer(): string
    {
        return $this->idoffer;
    }

    /**
     * @return string
     */
    public function getRequiredUser(): string
    {
        return $this->requiredUser;
    }



}