<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use App\Shared\Domain\Event\EventInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonEventSerializer implements EventSerializerInterface
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function serialize(EventInterface $event): EventData
    {
        return new EventData($this->serializer->serialize($event, 'json'));
    }
}
