<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class EventLog
{
    #[Id]
    #[Column(type: 'string')]
    private readonly string $id;

    #[Column(type: 'string')]
    private string $event;

    #[Column(type: 'json')]
    private string $data;

    #[Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;
}
