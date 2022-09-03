<?php

declare(strict_types=1);

namespace App\Tests\Write\RegisterCompany\Presentation;

use App\Tests\SmokeTestCase;
use App\Tests\Utils\HttpMethod;

final class RegisterCompanyControllerTest extends SmokeTestCase
{
    private RegisterCompanyControllerTestData $testData;

    public function test_ShouldReturn204StatusCode_WhenCompanyRegisteredSuccessfully(): void
    {
        $response = $this->postRequest(HttpMethod::POST, $this->testData->getUrl(), $this->testData->getBody());

        self::assertEquals(204, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RegisterCompanyControllerTestData();
    }
}
