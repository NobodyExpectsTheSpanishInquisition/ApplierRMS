<?php

namespace App\Tests\Shared\Infrastructure\Event\EventStore;

use App\Tests\IntegrationTestCase;
use App\Write\Shared\Infrastructure\Event\EventStore\EventSerializerInterface;

final class EventSerializerInterfaceTest extends IntegrationTestCase
{
    private EventSerializerInterface $serializer;

    public function test_Serialize_ShouldSerializeEvent(): void
    {
        $eventPropertyValue = 'test';

        $result = $this->serializer->serialize(new EventStub($eventPropertyValue));

        self::assertJson($result);
        self::assertJsonStringEqualsJsonFile(__DIR__ . '/SerializedEventStub.json', $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->container->get(EventSerializerInterface::class);
    }
}
