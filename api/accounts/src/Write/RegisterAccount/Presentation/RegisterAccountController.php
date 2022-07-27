<?php

declare(strict_types=1);

namespace App\Write\RegisterAccount\Presentation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterAccountController extends AbstractController
{
    public function register(Request $request): JsonResponse
    {
    }
}
