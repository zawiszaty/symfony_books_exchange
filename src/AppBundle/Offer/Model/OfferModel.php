<?php


namespace AppBundle\Offer\Model;


class OfferModel
{
    /**
     * @var string
     */
    private $idoffer;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $seen = '0';

    /**
     * @var boolean
     */
    private $accepted = '0';

    /**
     * @var boolean
     */
    private $rejected = '0';

    /**
     * @var \AppBundle\Entity\Book
     */
    private $offeredBook;

    /**
     * @var \AppBundle\Entity\Book
     */
    private $requiredBook;

    /**
     * @var \AppBundle\Entity\User
     */
    private $offeredUser;

    /**
     * @var \AppBundle\Entity\User
     */
    private $requiredUser;

    /**
     * OfferModel constructor.
     *
     * @param string $idoffer
     * @param string $description
     * @param bool $seen
     * @param bool $accepted
     * @param bool $rejected
     * @param \AppBundle\Entity\Book $offeredBook
     * @param \AppBundle\Entity\Book $requiredBook
     * @param \AppBundle\Entity\User $offeredUser
     * @param \AppBundle\Entity\User $requiredUser
     */
    public function __construct(
        string $idoffer,
        string $description,
        int $seen,
        int $accepted,
        int $rejected,
        \AppBundle\Entity\Book $offeredBook,
        \AppBundle\Entity\Book $requiredBook,
        \AppBundle\Entity\User $offeredUser,
        \AppBundle\Entity\User $requiredUser
    ) {
        $this->idoffer = $idoffer;
        $this->description = $description;
        $this->seen = $seen;
        $this->accepted = $accepted;
        $this->rejected = $rejected;
        $this->offeredBook = $offeredBook;
        $this->requiredBook = $requiredBook;
        $this->offeredUser = $offeredUser;
        $this->requiredUser = $requiredUser;
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
     * @return \AppBundle\Entity\Book
     */
    public function getOfferedBook(): \AppBundle\Entity\Book
    {
        return $this->offeredBook;
    }

    /**
     * @return \AppBundle\Entity\Book
     */
    public function getRequiredBook(): \AppBundle\Entity\Book
    {
        return $this->requiredBook;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getOfferedUser(): \AppBundle\Entity\User
    {
        return $this->offeredUser;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getRequiredUser(): \AppBundle\Entity\User
    {
        return $this->requiredUser;
    }

}