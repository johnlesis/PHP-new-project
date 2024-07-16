<?php

namespace John\Fun\Application;

use John\Fun\Application\ApplicationException;

class RegisterPatientRequestValidator implements RequestValidator
{
    private array $errors = [];

    use ExceptionMessageValidatorTrait;
    
    public function validate(ApplicationRequest $request): bool
    {
        if(!($request instanceof RegisterPatientRequest)) {
            throw new ApplicationException("Invalid Request Type");
        }

        // Potentially throw a buiseness Exception
        $initialErrors = [];

        $errors = $this->validateName($initialErrors, $request->getName());
        $errors = $this->validateEmail($errors, $request->getEmail());

        $this->errors = $errors;

        return count($errors) == 0;
    }
    
    private function validateName(array $errors, $name): array 
    {   
        if (strlen($name) < 3){
            $errors[] = "To onoma den prepei na exei kato apo 3 xaraktiires";
        }

        return $errors;
    }

    private function validateEmail(array $errors, $email): array 
    {
        if(!strpos($email, "@")) {
            $errors[] = "Ivalid Email";
        }

        return $errors;
    }
}