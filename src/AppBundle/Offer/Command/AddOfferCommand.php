<?php


namespace AppBundle\Offer\Command;


final class AddOfferCommand
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var boolean
     */
    public $seen = '0';

    /**
     * @var boolean
     */
    public $accepted = '0';

    /**
     * @var boolean
     */
    public $rejected = '0';

    /**
     * @var string
     */
    public $offeredBook;

    /**
     * @var string
     */
    public $requiredBook;

    /**
     * @var string
     */
    public $offeredUser;

    /**
     * @var string
     */
    public $requiredUser;

    /**
     * AddOfferCommand constructor.
     * @param string $description
     * @param string $offeredBook
     * @param string $requiredBook
     */
    public function __construct($description, string $offeredBook, string $requiredBook, string $offeredUser, string $requiredUser)
    {
        $this->description = $description;
        $this->seen = 0;
        $this->accepted = 0;
        $this->rejected = 0;
        $this->offeredBook = $offeredBook;
        $this->requiredBook = $requiredBook;
        $this->offeredUser = $offeredUser;
        $this->requiredUser = $requiredUser;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isSeen(): bool
    {
        return $this->seen;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->rejected;
    }

    /**
     * @return string
     */
    public function getIdoffer(): string
    {
        return $this->idoffer;
    }

    /**
     * @return string
     */
    public function getOfferedBook(): string
    {
        return $this->offeredBook;
    }

    /**
     * @return string
     */
    public function getRequiredBook(): string
    {
        return $this->requiredBook;
    }

    /**
     * @return string
     */
    public function getOfferedUser(): string
    {
        return $this->offeredUser;
    }

    /**
     * @return string
     */
    public function getRequiredUser(): string
    {
        return $this->requiredUser;
    }

}