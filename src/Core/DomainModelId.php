<?php

namespace John\Fun\Core;

class DomainModelId
{
    private $id;

    public function __construct() {
        $this->id = uniqid("CLINIC");
    }

    public function toString(): string
    {
        return $this->id;
    }
}