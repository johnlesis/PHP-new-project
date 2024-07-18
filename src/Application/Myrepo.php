<?php
namespace John\Fun\Application;

use John\Fun\Core\Patient;

interface MyRepo
{
  public function findById(string $id): ?Patient;

  public function persistNewPatient(Patient $patient): bool;
}