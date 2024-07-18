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
    private array $administeredDrugs = [];

    public function __construct(string $name, string $email, Ssn $ssn, Datetime $dob, string $gender)
    {
        $this->id = new DomainModelId();
        $this->name = $name;
        $this->email = $email;
        $this->ssn = $ssn;
        $this->dob = $dob;
        $this->gender = $gender;
    }

    use IdTrait;

    public function administerDrug(Drug $drug, string $administeredAt): void
    {
        $this->administeredDrugs[] = [
            'drug ' => $drug,
            'administeredAt ' => $administeredAt
        ];
    }


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

    public function getAdministeredDrugs(): array
    {
        return $this->administeredDrugs;
    }


}