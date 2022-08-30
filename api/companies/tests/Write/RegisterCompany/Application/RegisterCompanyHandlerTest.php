<?php

declare(strict_types=1);

namespace App\Tests\Write\RegisterCompany\Application;

use App\Tests\UnitTestCase;
use App\Tests\Utils\EventBusSpy;
use App\Write\RegisterCompany\Application\RegisterCompanyHandler;
use App\Write\Shared\Domain\Event\CompanyRegistered;

final class RegisterCompanyHandlerTest extends UnitTestCase
{
    private RegisterCompanyHandler $handler;
    private RegisterCompanyHandlerTestData $testData;
    private EventBusSpy $eventBusSpy;

    public function test_Invoke_ShouldRegisterCompany(): void
    {
        $handler = $this->handler;
        $handler($this->testData->getCommand());

        self::assertCount(1, $this->eventBusSpy->getEvents());
        self::assertInstanceOf(CompanyRegistered::class, $this->eventBusSpy->getFirstEvent());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $factoriesFactory = $this->createTestFactoriesFactory();

        $this->eventBusSpy = $this->createEventBusSpy();
        $this->handler = new RegisterCompanyHandler(
            $factoriesFactory->newCompanyFactory(),
            $factoriesFactory->newAccountIdFactory(),
            $factoriesFactory->newUserIdFactory(),
            $this->eventBusSpy
        );
        $this->testData = new RegisterCompanyHandlerTestData();
    }
}
