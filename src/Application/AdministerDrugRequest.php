<?php

namespace John\Fun\Application;

class AdministerDrugRequest implements ApplicationRequest
{
  private string $patientId;
  private string $drugName;
  private float $dosage;
  private string $administeredAt;

  public function __construct(string $patientId, string $drugName, float $dosage, string $administeredAt)
  {
    $this->patientId = $patientId;
    $this->drugName = $drugName;
    $this->dosage = $dosage;
    $this->administeredAt = $administeredAt;
  }

  public function getPatientId(): string
  {
    return $this->patientId;
  }

  public function getDrugName(): string
  {
    return $this->drugName;
  }

  public function getDosage(): float
  {
    return $this->dosage;
  }

  public function getAdministeredAt(): string
  {
    return $this->administeredAt;
  }
}
