<?php

namespace John\Fun\Core;

use DateTime;

class Patient  implements  DomainModel
{
    private DomainModelId $id;
    private string $name;
    private string $email;
    private DateTime $dob;
    private Ssn $ssn;

    public function __construct(string $name, string $email, Ssn $ssn)
    {
        $this->name = $name;
        $this->email = $email;
        $this->ssn = $ssn;
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

}