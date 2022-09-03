<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Application;

use App\Shared\Domain\Factory\AccountIdFactoryInterface;
use App\Shared\Domain\Factory\UserIdFactoryInterface;
use App\Write\Shared\Application\Cqrs\CommandHandlerInterface;
use App\Write\Shared\Domain\Event\CompanyRegistered;
use App\Write\Shared\Domain\Event\EventBusInterface;
use App\Write\Shared\Domain\Factory\CompanyFactory;

final class RegisterCompanyHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CompanyFactory $companyFactory,
        private readonly AccountIdFactoryInterface $accountIdFactory,
        private readonly UserIdFactoryInterface $userIdFactory,
        private readonly EventBusInterface $eventBus
    ) {
    }

    public function __invoke(RegisterCompanyCommand $command): void
    {
        $accountId = $this->accountIdFactory->newAccountId();
        $mainUserId = $this->userIdFactory->newUserId();

        $company = $this->companyFactory->create(
            $command->id,
            $command->companyName,
            $accountId,
            $mainUserId,
            $command->firstName,
            $command->lastName,
            $command->email
        );

        $this->eventBus->push(new CompanyRegistered($company));
        $this->eventBus->dispatch();
    }
}
