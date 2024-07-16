<?php

namespace John\Fun\Core;

interface Ssn
{
  public function toString(): string;

  public function getCountry(): string; 
}