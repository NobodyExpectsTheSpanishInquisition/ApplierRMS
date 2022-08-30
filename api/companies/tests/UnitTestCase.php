<?php

declare(strict_types=1);

namespace App\Tests;

use App\Tests\Utils\EventBusSpy;
use App\Tests\Utils\TestFactoriesFactory;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function createTestFactoriesFactory(): TestFactoriesFactory
    {
        return new TestFactoriesFactory();
    }

    protected function createEventBusSpy(): EventBusSpy
    {
        return new EventBusSpy();
    }
}
