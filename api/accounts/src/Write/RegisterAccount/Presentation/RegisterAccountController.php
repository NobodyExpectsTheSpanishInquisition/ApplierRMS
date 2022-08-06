<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterAccountController extends AbstractController
{
    public function __construct(private RegisterAccountRequestDenormalizer $denormalizer)
    {
    }

    public function register(Request $request): JsonResponse
    {
        $denormalizedRequest = $this->denormalizer->denormalize($request, RegisterAccountRequest::class);

        return new JsonResponse();
    }
}
