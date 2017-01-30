<?php

namespace MyCompany\Book\DomainModel;

use Ramsey\Uuid\Uuid;

class BookEntity
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var \DateTime */
    private $createdAt;

    public static function create(
        string $title
    ) {
        $self = new self();
        $self->id = Uuid::uuid4()->toString();
        $self->title = $title;
        $self->createdAt = new \Datetime("now");
        return $self;
    }

    /**
     * @return string
     */
    public function id() : string
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

    /**
     * @return \DateTime
     */
    public function createdAt() : \DateTime
    {
        return $this->createdAt;
    }
}