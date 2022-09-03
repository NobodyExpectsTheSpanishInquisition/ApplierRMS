<?php

declare(strict_types=1);

namespace App\Tests\Utils;

use App\Shared\Domain\Factory\AccountIdFactoryInterface;
use App\Shared\Domain\Factory\UserIdFactoryInterface;
use App\Shared\Infrastructure\Uuid\IdFactory;
use App\Write\Shared\Domain\Factory\AccountFactory;
use App\Write\Shared\Domain\Factory\CompanyFactory;
use App\Write\Shared\Domain\Factory\UserFactory;
use Ramsey\Uuid\UuidFactory;

final class TestFactoriesFactory
{
    public function newCompanyFactory(): CompanyFactory
    {
        return new CompanyFactory($this->newAccountFactory());
    }

    private function newAccountFactory(): AccountFactory
    {
        return new AccountFactory($this->newUserFactory());
    }

    private function newUserFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function newAccountIdFactory(): AccountIdFactoryInterface
    {
        return $this->newIdFactory();
    }

    private function newIdFactory(): IdFactory
    {
        return new IdFactory(new UuidFactory());
    }

    public function newUserIdFactory(): UserIdFactoryInterface
    {
        return $this->newIdFactory();
    }
}
