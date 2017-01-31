<?php

namespace MyCompany\Book\DomainModel;

use MyCompany\Identity\DomainModel\EntityID;

class CreateBookCommand
{
    /** @var EntityID */
    private $id;
    /** @var string */
    private $title;

    public function __construct(
        EntityID $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * @return EntityID
     */
    public function id() : EntityID
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title() : string
    {
        return $this->title;
    }
}
