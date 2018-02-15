<?php

namespace AppBundle\Book\Command;


/**
 * Class EditBookCommand
 * @package AppBundle\Book\Command
 */
final class EditBookCommand
{
    /**
     * @var string
     */
    public $idBook;

    /**
     * @var string
     *
     */
    public $name;

    /**
     * @var string
     *
     */
    public $description;

    /**
     * @var string
     *
     */
    public $address;

    /**
     * @var float
     *
     */
    public $lat;

    /**
     * @var float
     *
     */
    public $lng;

    /**
     * @var string
     *
     */
    public $type;

    /**
     * @var string
     *
     *
     */
    public $categorycategory;

    /**
     * AddBookCommand constructor.
     * @param string $idBook
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param string $categorycategory
     */
    public function __construct(
        string $idBook,
        string $name,
        string $description,
        string $address,
        float $lat,
        float $lng,
        string $type,
        string $categorycategory
    )
    {
        $this->idBook = $idBook;
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = floatval($lat);
        $this->lng = floatval($lng);
        $this->type = $type;
        $this->categorycategory = $categorycategory;
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
    public function getCategorycategory(): string
    {
        return $this->categorycategory;
    }

    /**
     * @return string
     */
    public function getIdBook(): string
    {
        return $this->idBook;
    }

}