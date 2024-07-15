<?php

namespace John\Fun\Application;

trait ExceptionMessageValidatorTrait
{
    public function getExceptionMessage(): string
    {
        return join(", ", $this->errors);
    }
}