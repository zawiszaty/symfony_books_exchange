<?php

namespace AppBundle\Offer\Command;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraint\ExistingField\ExistingField;

/**
 * Class SeenOfferCommand
 * @package AppBundle\Offer\Command
 */
final class SeenOfferCommand
{

    /**
     * @var array
     * @Assert\Type("array")
     * @Assert\NotBlank()
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