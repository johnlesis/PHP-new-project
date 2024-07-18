<?php

namespace John\Fun\Application;

use John\Fun\Core\DomainException;
use John\Fun\Core\Myrepo;
use John\Fun\Core\Drug;
use Datetime;



class AdministerDrug
{
  private MyRepo $patientRepository;
  private RequestValidator $validator;

  public function __construct(MyRepo $patientRepository, RequestValidator $validator)
  {
    $this->patientRepository = $patientRepository;
    $this->validator = $validator;
  }

  public function handle(AdministerDrugRequest $request): void
  {
    if (!$this->validator->validate($request)) {
      throw new DomainException($this->validator->getExceptionMessage());
    }

    $patient = $this->patientRepository->findById($request->getPatientId());

    if ($patient === null) {
      throw new DomainException("Patient not found");
    }

    $drug = new Drug(
      $request->getPatientId(),
      $request->getDrugName(),
      $request->getDosage(),
      $request->getAdministeredAt()
    );
    $administeredAt = DateTime::createFromFormat('Y-m-d', $request->getAdministeredAt());
    if (!$administeredAt) {
      throw new DomainException("Invalid administered at date format, should be YYYY-MM-DD");
    }

    $patient->administerDrug($drug, $administeredAt);

    $this->patientRepository->persistNewPatient($patient);
  }
}
