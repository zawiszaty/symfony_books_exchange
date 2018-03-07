<?php

namespace AppBundle\Offer\Command;


class SeenOfferCommand
{
    /*
     * @var string[]
     */
    public $idoffer;

    /**
     * SeenOfferCommand constructor.
     * @param $idoffer
     */
    public function __construct(array $idoffer)
    {
        $this->idoffer = $idoffer;
    }

    /**
     * @return array
     */
    public function getIdoffer(): array
    {
        return $this->idoffer;
    }

}