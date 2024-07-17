<?php

namespace John\Fun\Application;

use DateTime;

class RegisterPatientRequest implements ApplicationRequest
{
    private string $name;
    private string $email;
    private string $ssnString;
    private string $ssnCountry;
    private Datetime $dob;
    private string $gender;


    public function __construct(string $name, string $email, string $ssnCountry, string $ssnString, DateTime $dob, string $gender)
    {
        $this->name = $name;
        $this->email = $email;
        $this->ssnCountry = $ssnCountry;
        $this->ssnString = $ssnString;
        $this->dob = $dob;
        $this->gender = $gender;

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

    public function getDob(): Datetime
    {
        return $this->dob;
    }
    public function getGender(): string
    {
        return $this->gender;
    }

}