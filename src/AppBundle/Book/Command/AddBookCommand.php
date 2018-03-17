<?php


namespace AppBundle\Book\Command;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraint\ExistingField\ExistingField;

final class AddBookCommand
{
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
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @ExistingField(entityClass="AppBundle\Entity\User", field="id")
     */
    public $user;

    /**
     * AddBookCommand constructor.
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param $user
     */
    public function __construct(
        string $name,
        string $description,
        string $address,
        float $lat,
        float $lng,
        string $type,
        string $user
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = floatval($lat);
        $this->lng = floatval($lng);
        $this->type = $type;
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
    public function getUser(): string
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

}