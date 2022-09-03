<?php

declare(strict_types=1);

namespace App\Tests;

use App\Tests\Utils\HttpMethod;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SmokeTestCase extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();
    }

    /**
     * @param array<string, mixed> $body
     */
    protected function postRequest(HttpMethod $httpMethod, string $uri, array $body): Response
    {
        $this->client->request($httpMethod->name, $uri, $body);

        return $this->client->getResponse();
    }
}
