<?php

namespace John\Fun\Application;

use John\Fun\Core\Patient;
use John\Fun\Core\Ssn;

interface PatientRepository
{
    public function patientExists(Ssn $ssn): bool;

    public function persistNewPatient(Patient $patient): bool;
}