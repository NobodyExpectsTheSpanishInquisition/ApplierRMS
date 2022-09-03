<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Presentation;

use App\Shared\Presentation\Validation\ValidationBuilder;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Validator\Validation;

final class RegisterCompanyRequestDenormalizerFactory
{
    public static function create(): RegisterCompanyRequestDenormalizer
    {
        return new RegisterCompanyRequestDenormalizer(
            new PropertyNormalizer(),
            new JsonDecode(),
            new ValidationBuilder(Validation::createValidator())
        );
    }
}
