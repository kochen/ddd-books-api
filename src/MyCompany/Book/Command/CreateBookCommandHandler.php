<?php

namespace MyCompany\Book\Command;

use MyCompany\Book\DomainModel\BookEntity;
use MyCompany\Book\DomainModel\BookRepository;

class CreateBookCommandHandler
{
    /** @var BookRepository */
    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }
    /**
     * @param CreateBookCommand $command
     */
    public function handle(CreateBookCommand $command)
    {
        $bookEntity = BookEntity::create(
            $command->id(),
            $command->title(),
            $command->author()
        );

        $this->bookRepository->save($bookEntity);
    }
}
