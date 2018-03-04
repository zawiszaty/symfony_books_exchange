<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Offer
 *
 * @ORM\Table(name="offer", indexes={@ORM\Index(name="fk_offer_book1_idx", columns={"offered_book"}), @ORM\Index(name="fk_offer_book2_idx", columns={"required_book"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 */
class Offer
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seen", type="boolean", nullable=false)
     */
    private $seen = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="accepted", type="boolean", nullable=false)
     */
    private $accepted = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rejected", type="boolean", nullable=false)
     */
    private $rejected = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="idoffer", type="string", length=255)
     * @ORM\Id
     */
    private $idoffer;

    /**
     * @var \AppBundle\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offered_book", referencedColumnName="idbook")
     * })
     */
    private $offeredBook;

    /**
     * @var \AppBundle\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="required_book", referencedColumnName="idbook")
     * })
     */
    private $requiredBook;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offered_user", referencedColumnName="id")
     * })
     */
    private $offeredUser;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="required_user", referencedColumnName="id")
     * })
     */
    private $requiredUser;

    /**
     * Offer constructor.
     *
     * @param string $description
     * @param Book $offeredBook
     * @param Book $requiredBook
     * @param $offeredUser
     * @param User $requiredUser
     * @param int $seen
     * @param int $accepted
     * @param int $rejected
     */
    public function __construct(
        string $description,
        Book $offeredBook,
        Book $requiredBook,
        User $offeredUser,
        User $requiredUser,
        int $seen,
        int $accepted,
        int $rejected
    ) {
        $this->description = $description;
        $this->idoffer = Uuid::uuid4();
        $this->offeredBook = $offeredBook;
        $this->requiredBook = $requiredBook;
        $this->requiredUser = $requiredUser;
        $this->offeredUser = $offeredUser;
        $this->seen = $seen;
        $this->accepted = $accepted;
        $this->rejected = $rejected;
    }

    /**
     * @return string
     */
    public
    function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public
    function isSeen(): bool
    {
        return $this->seen;
    }

    /**
     * @return bool
     */
    public
    function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @return bool
     */
    public
    function isRejected(): bool
    {
        return $this->rejected;
    }

    /**
     * @return string
     */
    public
    function getIdoffer(): string
    {
        return $this->idoffer;
    }

    /**
     * @return Book
     */
    public
    function getOfferedBook(): Book
    {
        return $this->offeredBook;
    }

    /**
     * @return Book
     */
    public
    function getRequiredBook(): Book
    {
        return $this->requiredBook;
    }

    /**
     * @return User
     */
    public
    function getOfferedUser(): User
    {
        return $this->offeredUser;
    }

    /**
     * @return User
     */
    public
    function getRequiredUser(): User
    {
        return $this->requiredUser;
    }

    public
    function acceptedOffer(): void
    {
        $this->accepted = 1;
    }

    public
    function rejectedOffer(): void
    {
        $this->rejected = 1;
    }
}

