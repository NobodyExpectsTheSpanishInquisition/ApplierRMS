<?php

namespace App\Tests\Shared\Infrastructure\Event\EventStore;

use App\Tests\IntegrationTestCase;
use App\Tests\Stub\EventStub;
use App\Write\Shared\Infrastructure\Event\EventStore\EventSerializerInterface;

final class EventSerializerInterfaceTest extends IntegrationTestCase
{
    private EventSerializerInterface $serializer;

    public function test_Serialize_ShouldSerializeEvent(): void
    {
        $eventPropertyValue = 'test';

        $result = $this->serializer->serialize(new EventStub($eventPropertyValue));

        self::assertJson($result->eventData);
        self::assertJsonStringEqualsJsonFile(__DIR__ . '/SerializedEventStub.json', $result->eventData);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->container->get(EventSerializerInterface::class);
    }
}
