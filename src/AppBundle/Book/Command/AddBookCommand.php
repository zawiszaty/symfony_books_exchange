<?php


namespace AppBundle\Book\Command;


final class AddBookCommand
{
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

    public $user;

    /**
     * AddBookCommand constructor.
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param string $categorycategory
     * @param $user
     */
    public function __construct(
        string $name,
        string $description,
        string $address,
        float $lat,
        float $lng,
        string $type,
        string $categorycategory,
        string $user
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = floatval($lat);
        $this->lng = floatval($lng);
        $this->type = $type;
        $this->categorycategory = $categorycategory;
        $this->user = $user;
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
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
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

    public function getCategorycategory(): string
    {
        return $this->categorycategory;
    }

}