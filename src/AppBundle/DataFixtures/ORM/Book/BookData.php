<?php

namespace AppBundle\DataFixtures\ORM\Book;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use MyCompany\Identity\Infrastructure\UUID;

use MyCompany\Book\DomainModel\BookEntity;

class BookData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager)
  {
      $book = BookEntity::create(UUID::create(), 'Test book 1');
      $manager->persist($book);

      $book = BookEntity::create(UUID::create(), 'Test book 2');
      $manager->persist($book);

      $manager->flush();
  }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}