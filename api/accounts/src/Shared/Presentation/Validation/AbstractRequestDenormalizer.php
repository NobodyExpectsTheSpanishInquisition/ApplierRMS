<?php

declare(strict_types=1);

namespace App\Shared\Presentation\Validation;

use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

abstract class AbstractRequestDenormalizer
{
    public function __construct(
        private DenormalizerInterface $denormalizer,
        private DecoderInterface $decoder,
        private ValidationBuilderInterface $validationBuilder
    ) {
    }

    public function denormalize(Request $request, string $targetClassname): object
    {
        $content = $request->getContent();

        $contentArray = $this->decode($content);

        $this->assert($contentArray);

        return $this->denormalizeToObject($contentArray, $targetClassname);
    }

    /**
     * @return array<int|string, mixed>
     */
    private function decode(string $content): array
    {
        return $this->decoder->decode($content, 'array', ['json_decode_associative' => true]);
    }

    /**
     * @param array<int|string, mixed> $data
     */
    abstract protected function assert(array $data): void;

    /**
     * @param array<int|string, mixed> $data
     */
    private function denormalizeToObject(array $data, string $targetClassname): object
    {
        try {
            return $this->denormalizer->denormalize($data, $targetClassname);
        } catch (ExceptionInterface $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    protected function getValidationBuilder(): ValidationBuilderInterface
    {
        return $this->validationBuilder;
    }
}
