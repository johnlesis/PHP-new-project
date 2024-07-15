<?php

namespace John\Fun\Application;

use DomainException;
use John\Fun\Application\ApplicationException;
use John\Fun\Core\Patient;
use John\Fun\Core\SsnFactory;

class CreatePatient
{
    private SsnFactory $ssnFactory;
    private PatientRepository $patientRepository;

    public function __construct(SsnFactory $ssnFactory, PatientRepository $patientRepository) 
    {
        $this->ssnFactory = $ssnFactory;
        $this->patientRepository = $patientRepository;
    }

    public function handle(CreatePatientRequest $request): Patient
    {
        // 1. Validate Request
        $validator = new CreatePatientValidator();
        
        if(!$validator->validate($request)) {
            throw new ApplicationException($validator->getExceptionMessage());
        }

        // 2. Instanciate Patient from request
        // Somehow i have to know what kind of Ssn have to create.....
        $ssn=$this->ssnFactory->createSsn($request->getSsnString(), $request->getSsnCountry());
        
        if($this->patientRepository->patientExists($ssn))
        {
            throw new DomainException("Patient with ssn #{$ssn->toString()} exists");
        }

        $patient = new Patient($request->getName(), $request->getEmail(), $ssn);

        // 3. Persist the instance?? -> This is side effect
        // 4. Return the validated Patient Object
        return $patient;
    }
}