<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

use App\Write\RegisterAccount\Application\RegisterAccountCommand;
use App\Write\Shared\Application\Cqrs\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterAccountController extends AbstractController
{
    public function __construct(
        private readonly RegisterAccountRequestDenormalizer $denormalizer,
        private readonly CommandBusInterface $commandBus
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        /** @var RegisterAccountRequest $denormalizedRequest */
        $denormalizedRequest = $this->denormalizer->denormalize($request, RegisterAccountRequest::class);

        $this->commandBus->dispatch(
            new RegisterAccountCommand(
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
