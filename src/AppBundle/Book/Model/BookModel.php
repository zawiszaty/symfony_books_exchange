<?php


namespace AppBundle\Book\Model;


use AppBundle\Entity\User;

/**
 * Class BookModel
 * @package AppBundle\Book\Model
 */
final class BookModel
{
    /**
     * @var string
     */
    private $idbook;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $address;

    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $lng;

    /**
     * @var string
     */
    private $type;


    /*
     * @var User
     */
    /**
     * @var User
     */
    private $user;

    /**
     * BookModel constructor.
     * @param string $idbook
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param User $user
     */
    public function __construct(
        string $idbook,
        string $name,
        string $description,
        string $address,
        float $lat,
        float $lng,
        string $type,
        User $user
    )
    {
        $this->idbook = $idbook;
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->type = $type;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getIdbook(): string
    {
        return $this->idbook;
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
     * @return User
     */
    public function getUser(): User
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