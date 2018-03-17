<?php

namespace AppBundle\Offer\Command;

use AppBundle\Validator\Constraint\ExistingField\ExistingField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AcceptedOfferCommand
 * @package AppBundle\Offer\Command
 */
final class AcceptedOfferCommand
{
    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @ExistingField(entityClass="AppBundle\Entity\Offer", field="idoffer")
     */
    public $idoffer;

    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @ExistingField(entityClass="AppBundle\Entity\User", field="id")
     */
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