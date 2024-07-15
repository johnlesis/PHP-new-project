<?php

namespace John\Fun\Application;

interface RequestValidator
{
    public function validate(ApplicationRequest $request): bool;

    public function getExceptionMessage(): string;
}