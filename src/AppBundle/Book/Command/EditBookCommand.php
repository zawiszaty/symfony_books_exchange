<?php

namespace AppBundle\Book\Command;

use AppBundle\Validator\Constraint\ExistingField\ExistingField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EditBookCommand
 * @package AppBundle\Book\Command
 */
/**
 * Class EditBookCommand
 * @package AppBundle\Book\Command
 */
final class EditBookCommand
{
    /**
     * @var string
     * @ExistingField(entityClass="AppBundle\Entity\Book", field="idCategory")
     */
    public $idBook;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     */
    public $description;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     */
    public $address;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     */
    public $lat;

    /**
     * @var float
     * @Assert\NotBlank()
     * @Assert\Type("float")
     *
     */
    public $lng;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     */
    public $type;



    /**
     * AddBookCommand constructor.
     * @param string $idBook
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     */
    public function __construct(
        string $idBook,
        string $name,
        string $description,
        string $address,
        float $lat,
        float $lng,
        string $type
    )
    {
        $this->idBook = $idBook;
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = floatval($lat);
        $this->lng = floatval($lng);
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function getIdBook(): string
    {
        return $this->idBook;
    }

}