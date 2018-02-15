<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Book
 *
 * @ORM\Table(name="book", indexes={@ORM\Index(name="fk_book_category1_idx", columns={"category_idcategory"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 */
class Book
{
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

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     * })
     */
    private $categorycategory;

    /**
     * Book constructor.
     * @param string $name
     * @param string $description
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param string $type
     * @param bool $archived
     * @param string $idlbook
     * @param Category $categorycategory
     */
    public function __construct(
        string $name,
        string $description,
        string $address,
        string $lat,
        string $lng,
        string $type,
        Category $categorycategory
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->type = $type;
        $this->idbook = Uuid::uuid4();
        $this->categorycategory = $categorycategory;
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
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }


    /**
     * @return Category
     */
    public function getCategorycategory(): Category
    {
        return $this->categorycategory;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @param float $lat
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @param float $lng
     */
    public function setLng(float $lng)
    {
        $this->lng = $lng;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;
    }

    /**
     * @param Category $categorycategory
     */
    public function setCategorycategory(Category $categorycategory)
    {
        $this->categorycategory = $categorycategory;
    }



}

