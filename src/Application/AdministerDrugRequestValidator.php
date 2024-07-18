<?php

namespace John\Fun\Application;

use John\Fun\Application\ApplicationException;

class AdministerDrugRequestValidator implements RequestValidator
{
  private array $errors = [];

  use ExceptionMessageValidatorTrait;

  private const ALLOWED_TYPES = ['Aspirin', 'Depon', 'Panadol', 'Viagra', 'Cyalis'];

  public function validate(ApplicationRequest $request): bool
  {
    if (!($request instanceof AdministerDrugRequest)) {
      throw new ApplicationException("Invalid Request Type");
    }

    $initialErrors = [];

    $errors = $this->validateType($initialErrors, $request->getDrugName());

    $this->errors = $errors;
    return count($errors) == 0;

  }

  private function validateType(array $errors, string $drugName): array
  {
    if (!in_array($drugName, self::ALLOWED_TYPES)) {
      $errors[] = "Invalid drug name. Allowed names are: " . implode(', ', self::ALLOWED_TYPES);
    }
    return $errors;
  }
}