<?php


namespace AppBundle\Repository;

use AppBundle\Entity\Book;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

final class BookRepository extends EntityRepository
{
    public function save(Book $book): void
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
    }

    public function removeElement(string $id): void
    {
        $book = $this->find($id);
        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }

    public function update(
        string $idBook,
        string $name,
        string $description,
        string $address,
        string $lat,
        string $lng,
        string $type,
        Category $categorycategory
    ): void
    {
        $book = $this->find($idBook);

        $book->setName($name);
        $book->setDescription($description);
        $book->setAddress($address);
        $book->setLat($lat);
        $book->setLng($lng);
        $book->setType($type);
        $book->setCategorycategory($categorycategory);

        $this->getEntityManager()->flush();
    }
}