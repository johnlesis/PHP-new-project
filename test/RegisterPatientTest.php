<?php declare(strict_types=1);

use John\Fun\Application\ApplicationException;
use John\Fun\Application\RegisterPatient;
use John\Fun\Application\RegisterPatientRequest;
use John\Fun\Application\PatientRepository;
use John\Fun\Core\DomainException;
use John\Fun\Core\Patient;
use John\Fun\Core\SsnFactory;
use John\Fun\Infrastructure\FakeRepository\FakePatientRepository;
use PHPUnit\Framework\TestCase;

final class RegisterPatientTest extends TestCase
{
    protected PatientRepository $patientRepository;
    protected SsnFactory $ssnFactory;

    protected function setUp(): void
    {
        $this->patientRepository = new FakePatientRepository();
        $this->ssnFactory = new SsnFactory();
    }

    public function testHandleRegisterPatientCorrectly(): void
    {
        $validName = "john lessis";
        $validEmail = "johnlesis91@.gmail.com";
        $validSsnString = "20019102852";
        $validSsnCountry = "GR";
        $validDob = new DateTime('1991-01-20');
        $validGender = "Male";

        $validRequest = new RegisterPatientRequest($validName, $validEmail, $validSsnString, $validSsnCountry, $validDob, $validGender);
        $ssn = $this->ssnFactory->createSsn("20019102852", "GR");

        $useCase = new RegisterPatient($this->ssnFactory, $this->patientRepository);
        $patient = $useCase->handle($validRequest);


        $this->assertInstanceOf(Patient::class, $patient);
        $this->assertEquals($validName, $patient->getName());
        $this->assertEquals($validEmail, $patient->getEmail());
        $this->assertEquals($validSsnString, $patient->getSsn()->toString());
        $this->assertEquals($validDob, $patient->getDob());
        $this->assertEquals($validGender, $patient->getGender());
    }
}