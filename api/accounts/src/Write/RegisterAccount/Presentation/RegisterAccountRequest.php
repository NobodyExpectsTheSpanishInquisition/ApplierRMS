<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

final class RegisterAccountRequest
{
    public function __construct(
        private string $id,
        private string $companyName,
        private string $userFirstName,
        private string $userLastName,
        private string $userEmail
    ) {
    }
}
