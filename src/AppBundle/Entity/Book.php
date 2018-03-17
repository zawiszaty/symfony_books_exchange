<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="book")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    protected $user;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=80, nullable=false)
     */
    private $address;
    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=6, nullable=false)
     */
    private $lat;
    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=6, nullable=false)
     */
    private $lng;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;
    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    private $archived = '0';
    /**
     * @var string
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $idbook;

    /** @ORM\Column(name="created", type="datetime", nullable=false) */
    private $created;

    /**
     * Book constructor.
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param User $user
     */
    public function __construct(
        string $name,
        string $description,
        string $address,
        string $lat,
        string $lng,
        string $type,
        User $user,
        $id = false
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->type = $type;
        $this->user = $user;
        if($id){
            $this->idbook = $id;
        } else {
            $this->idbook = Uuid::uuid4();
        }
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
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     */
    public function setLng(float $lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $created
     */
    public function setCreated(): void
    {
        $this->created = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }


}

