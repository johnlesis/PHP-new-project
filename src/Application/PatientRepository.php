<?php

namespace John\Fun\Application;

use John\Fun\Core\Ssn;

interface PatientRepository
{
    public function patientExists(Ssn $ssn): bool;
}