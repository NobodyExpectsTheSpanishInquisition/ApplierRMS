<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Uuid;

use App\Shared\Domain\Factory\AccountIdFactoryInterface;
use App\Shared\Domain\Factory\UserIdFactoryInterface;
use App\Shared\Domain\ValueObject\AccountId;
use App\Shared\Domain\ValueObject\UserId;
use App\Write\Shared\Application\Event\EventId;
use App\Write\Shared\Application\Event\EventIdFactoryInterface;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

final class IdFactory implements AccountIdFactoryInterface, UserIdFactoryInterface, EventIdFactoryInterface
{
    public function __construct(private readonly UuidFactoryInterface $uuidFactory)
    {
    }

    public function newAccountId(): AccountId
    {
        return new AccountId($this->newUuid()->toString());
    }

    private function newUuid(): UuidInterface
    {
        return $this->uuidFactory->uuid4();
    }

    public function newUserId(): UserId
    {
        return new UserId($this->newUuid()->toString());
    }

    public function newEventId(): EventId
    {
        return new EventId($this->newUuid()->toString());
    }
}
