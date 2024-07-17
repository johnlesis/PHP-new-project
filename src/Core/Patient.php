<?php

namespace John\Fun\Core;

use DateTime;

class Patient implements DomainModel
{
    private DomainModelId $id;
    private string $name;
    private string $email;
    private DateTime $dob;
    private Ssn $ssn;
    private string $gender;

    public function __construct(string $name, string $email, Ssn $ssn, Datetime $dob, string $gender)
    {
        $this->name = $name;
        $this->email = $email;
        $this->ssn = $ssn;
        $this->dob = $dob;
        $this->gender = $gender;
    }

    use IdTrait;

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSsn(): Ssn
    {
        return $this->ssn;

    }

    public function getDob(): DateTime
    {
        return $this->dob;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

}