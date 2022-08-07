<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Presentation;

use App\Write\RegisterCompany\Application\RegisterCompanyCommand;
use App\Write\Shared\Application\Cqrs\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterCompanyController extends AbstractController
{
    public function __construct(
        private readonly RegisterCompanyRequestDenormalizer $denormalizer,
        private readonly CommandBusInterface $commandBus
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        /** @var RegisterCompanyRequest $denormalizedRequest */
        $denormalizedRequest = $this->denormalizer->denormalize($request, RegisterCompanyRequest::class);

        $this->commandBus->dispatch(
            new RegisterCompanyCommand(
                $denormalizedRequest->getId(),
                $denormalizedRequest->getCompanyName(),
                $denormalizedRequest->getUserFirstName(),
                $denormalizedRequest->getUserLastName(),
                $denormalizedRequest->getUserEmail()
            )
        );

        return new JsonResponse(null, 204);
    }
}
