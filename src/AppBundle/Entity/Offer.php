<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer", indexes={@ORM\Index(name="fk_offer_book1_idx", columns={"offered_book"}), @ORM\Index(name="fk_offer_book2_idx", columns={"required_book"})})
 * @ORM\Entity
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
     * @var boolean
     *
     * @ORM\Column(name="accepted_seen", type="boolean", nullable=false)
     */
    private $acceptedSeen = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="rejected_seen", type="boolean", nullable=false)
     */
    private $rejectedSeen = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="idoffer", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoffer;

    /**
     * @var \AppBundle\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offered_book", referencedColumnName="idlbook")
     * })
     */
    private $offeredBook;

    /**
     * @var \AppBundle\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="required_book", referencedColumnName="idlbook")
     * })
     */
    private $requiredBook;


}

