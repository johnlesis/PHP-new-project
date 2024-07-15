<?php

namespace John\Fun\Core;

trait IdTrait
{
    public function getId(): DomainModelId
    {
        return $this->id;
    }
}