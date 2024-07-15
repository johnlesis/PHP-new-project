<?php

namespace John\Fun\Infrastructure\FakeRepository;

use John\Fun\Application\PatientRepository;
use John\Fun\Core\Ssn;

class FakePatientRepository implements PatientRepository
{
    public function patientExists(Ssn $ssn): bool
    {
        // NotFound for testing purpose
        if($ssn->toString() == "01011001122") {
            return true;
        }

        return false;
    }
}