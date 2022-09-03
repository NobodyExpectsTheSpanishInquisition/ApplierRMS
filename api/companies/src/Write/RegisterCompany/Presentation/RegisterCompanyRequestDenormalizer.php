<?php

declare(strict_types=1);

namespace App\Write\RegisterCompany\Presentation;

use App\Shared\Presentation\Validation\AbstractRequestDenormalizer;
use App\Shared\Presentation\Validation\ValidationRule;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Uuid;

final class RegisterCompanyRequestDenormalizer extends AbstractRequestDenormalizer
{
    private const ID_PROPERTY = 'id';
    private const COMPANY_NAME_PROPERTY = 'companyName';
    private const USER_FIRST_NAME_PROPERTY = 'userFirstName';
    private const USER_LAST_NAME_PROPERTY = 'userLastName';
    private const USER_EMAIL_PROPERTY = 'userEmail';

    /**
     * @inheritDoc
     */
    protected function assert(array $data): void
    {
        $this->getValidationBuilder()
            ->addValidationRule(new ValidationRule($data[self::ID_PROPERTY], [new Uuid([])]))
            ->addValidationRule(
                new ValidationRule($data[self::COMPANY_NAME_PROPERTY], [new Required(), new Type('string')])
            )
            ->addValidationRule(
                new ValidationRule($data[self::USER_FIRST_NAME_PROPERTY], [new Required(), new Type('string')])
            )
            ->addValidationRule(
                new ValidationRule($data[self::USER_LAST_NAME_PROPERTY], [new Required(), new Type('string')])
            )
            ->addValidationRule(new ValidationRule($data[self::USER_EMAIL_PROPERTY], [new Required(), new Email()]))
            ->validate();
    }
}
