<?php

namespace John\Fun\Core;

class Amka implements Ssn
{
    private $ssnString;

    public function __construct(string $ssnStringRequest)
    {
        // Validate String
        $this->ssnString = $ssnStringRequest;
    }

    public function toString(): string
    {
        return $this->ssnString;
    }

    public function getCountry(): string
    {
        return "GR";
    }
}