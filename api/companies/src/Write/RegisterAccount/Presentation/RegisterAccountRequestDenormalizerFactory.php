<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

use App\Shared\Presentation\Validation\ValidationBuilder;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Validator\Validation;

final class RegisterAccountRequestDenormalizerFactory
{
    public static function create(): RegisterAccountRequestDenormalizer
    {
        return new RegisterAccountRequestDenormalizer(
            new PropertyNormalizer(),
            new JsonDecode(),
            new ValidationBuilder(Validation::createValidator())
        );
    }
}
