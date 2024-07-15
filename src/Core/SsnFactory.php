<?php

namespace John\Fun\Core;

class SsnFactory
{
    public function createSsn(string $ssnString, string $ssnCountry): Ssn
    {
        switch ($ssnCountry) {
            case 'GR':
                return $this->createAmka($ssnString, $ssnCountry);
                break;
            
            default:
                throw new DomainException("Ssn Not implemented for this country");
        }
    }

    private function createAmka(string $ssnString, string $ssnCountry): Amka
    {
        if(strlen($ssnString) !== 11) {
            throw new DomainException("AMKA must contai 11 digits!!!");
        }

        if(!is_numeric($ssnString)) {
            throw new DomainException("AMKA must contain only digits!!!");
        }

        /*
        * Implement Business Logic that first 6 digits is a valid date!!!!
        */
        // Code for date check

        return new Amka($ssnString, $ssnCountry);
    }   
}