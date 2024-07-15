<?php

namespace John\Fun\Application;

class CreatePatientRequest implements ApplicationRequest
{
    private string $name;
    private string $email;
    private string $ssnString;
    private string $ssnCountry;
    
    public function __construct(string $name, string $email, string $ssnCountry, string $ssnString)
    {
        $this->name = $name;
        $this->email = $email;
        $this->ssnCountry = $ssnCountry;
        $this->ssnString = $ssnString;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSsnString(): string
    {
        return $this->ssnString;
    }

    public function getSsnCountry(): string
    {
        return $this->ssnCountry;
    }
}