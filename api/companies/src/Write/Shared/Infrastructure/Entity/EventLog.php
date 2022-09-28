<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Entity;

use App\Write\Shared\Application\Event\EventId;
use App\Write\Shared\Domain\Event\EventInterface;
use App\Write\Shared\Infrastructure\Event\EventStore\EventData;
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
    private readonly string $event;

    #[Column(type: 'json')]
    private readonly string $data;

    #[Column(type: 'datetime_immutable')]
    private readonly DateTimeImmutable $createdAt;

    public function __construct(EventId $id, EventInterface $event, EventData $data, DateTimeImmutable $createdAt)
    {
        $this->id = $id->uuid;
        $this->event = $event::class;
        $this->data = $data->eventData;
        $this->createdAt = $createdAt;
    }
}
