<?php

namespace tests\Unit\MyCompany\Book\Command;

use MyCompany\Book\Command\CreateBookCommand;
use MyCompany\Book\Command\CreateBookCommandHandler;
use MyCompany\Book\Infrastructure\Persistance\Fake\FakeBookRepository;

use MyCompany\Identity\Infrastructure\UUID;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateBookCommandHandlerTest extends WebTestCase
{
    /** @var CreateBookCommandHandler */
    private $commandHandler;

    public function setUp()
    {
        $bookRepository = new FakeBookRepository();
        $this->commandHandler = new CreateBookCommandHandler(
            $bookRepository
        );
    }

    public function testCommand()
    {
        $this->commandHandler->handle(new CreateBookCommand(
            UUID::create(),
            'TITLE',
            'AUTHOR'
        ));
        // if exception is thrown never reaches the assert null.
        static::assertNull(null);
    }
}