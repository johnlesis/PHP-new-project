<?php

namespace John\Fun\Core;

class Drug implements DomainModel
{
    private DomainModelId $id;
    private string $name;
    private string $type;
    private float $dosage;
    private string $manufacturer;


    public function __construct(string $name, string $type, float $dosage, string $manufacturer)
    {
        $this->name = $name;
        $this->type = $type;
        $this->dosage = $dosage;
        $this->manufacturer = $manufacturer;

    }
    use IdTrait;


    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDosage(): float
    {
        return $this->dosage;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

}


