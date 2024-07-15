<?php declare(strict_types=1);

use John\Fun\Application\ApplicationException;
use John\Fun\Application\CreatePatient;
use John\Fun\Application\CreatePatientRequest;
use John\Fun\Application\PatientRepository;
use John\Fun\Core\DomainException;
use John\Fun\Core\Patient;
use John\Fun\Core\SsnFactory;
use John\Fun\Infrastructure\FakeRepository\FakePatientRepository;
use PHPUnit\Framework\TestCase;

final class CreatePatientTest extends TestCase
{
    protected PatientRepository $patientRepository;
    protected SsnFactory $ssnFactory;

    protected function setUp(): void
    {
        $this->patientRepository = new FakePatientRepository();
        $this->ssnFactory = new SsnFactory(); 
    }

    public function testInvalidNameThrowsException(): void
    {
        $invalidName = "Gi";
        $validSsnString = "01011001123";
        $validSsnCountry = 'GR';

        $invalidRequest = new CreatePatientRequest($invalidName, "ingo@csl.gr", $validSsnString, $validSsnCountry);
        $ssn = $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);

        $useCase = new CreatePatient($this->ssnFactory, $this->patientRepository);

        $this->expectException(ApplicationException::class);
        $useCase->handle($invalidRequest);
    }

    public function testInvalidEmailThrowsException(): void
    {
        $invalidName = "Gi";
        $validSsnString = "01011001123";
        $validSsnCountry = 'GR';

        $invalidRequest = new CreatePatientRequest("Giannis Lessi", "ingo.csl.gr", $validSsnString, $validSsnCountry);
        $ssn = $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);

        $useCase = new CreatePatient($this->ssnFactory, $this->patientRepository);

        $this->expectException(ApplicationException::class);
        $useCase->handle($invalidRequest);
    }

    public function testInvalidLengthSsnExceptionRequest(): void
    {

        $validSsnString = "010110011";

        $validSsnCountry = 'GR';
        
        $this->expectException(DomainException::class);
        $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);
    }

    public function testInvalidSsnDigitsExceptionRequest(): void
    {
        $validSsnString = "010110011w2";

        $validSsnCountry = 'GR';
        
        $this->expectException(DomainException::class);
        $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);
    }

    public function testInvalidSsnCountryExceptionRequest(): void
    {
        $validSsnString = "01011001122";

        $validSsnCountry = 'UK';
        
        $this->expectException(DomainException::class);
        $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);
    }

    public function testCreatePatientWithValidRequest(): void
    {
        $validName = "Giannis Lessi";
        $validSsnString = "01011001123";
        $validSsnCountry = 'GR';

        $validRequest = new CreatePatientRequest("Giannis Lessi", "ingo@csl.gr", $validSsnCountry, $validSsnString);
        $ssn = $this->ssnFactory->createSsn($validSsnString, $validSsnCountry);

        $useCase = new CreatePatient($this->ssnFactory, $this->patientRepository);
        $patient = $useCase->handle($validRequest);

        $this->assertInstanceOf(Patient::class, $patient);
        $this->assertEquals($patient->getSsn()->toString(), $validSsnString);
    }
}