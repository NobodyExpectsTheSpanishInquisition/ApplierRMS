<?php

declare(strict_types=1);

namespace App\Write\Shared\Infrastructure\Event\EventStore;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

final class EventSerializerFactory
{
    public static function create(): JsonEventSerializer
    {
        $normalizers = [new PropertyNormalizer()];
        $encoder = [new JsonEncoder()];

        $serializer = new Serializer($normalizers, $encoder);

        return new JsonEventSerializer($serializer);
    }
}
