<?php

namespace John\Fun\Core;

use DomainException;
use DateTime;

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
        if (strlen($ssnString) !== 11) {
            throw new DomainException("AMKA must contain 11 digits!!!");
        }

        if (!is_numeric($ssnString)) {
            throw new DomainException("AMKA must contain only digits!!!");
        }

        $datePart = substr($ssnString, 0, 6);

        // Extract the day, month, and year
        $day = substr($datePart, 0, 2);
        $month = substr($datePart, 2, 2);
        $year = substr($datePart, 4, 2);

        // Adjust the year for the century (assuming 1900-2200)
        $currentYear = (int) (new DateTime())->format('Y');
        $currentCentury = (int) floor($currentYear / 100);
        $lastTwoDigitsCurrentYear = (int) ($currentYear % 100);

        if ($year >= $lastTwoDigitsCurrentYear) {
            $fullYear = $currentCentury - 1 . $year;
        } elseif ($year < 50) {
            $fullYear = $currentCentury . $year;
        } else {
            $fullYear = $currentCentury + 1 . $year;
        }

        // Validate the date
        if (!checkdate($month, $day, $fullYear)) {
            throw new DomainException("AMKA has an invalid date!!!");
        }

        // Determine gender based on the 10th character
        $genderDigit = (int) $ssnString[9]; // 10th character
        if (!is_numeric($genderDigit)) {
            throw new DomainException("The 10th character of AMKA must be a digit!!!");
        }
        $gender = ($genderDigit % 2 === 0) ? 'Female' : 'Male';

        return new Amka($ssnString, $ssnCountry);
    }
}
