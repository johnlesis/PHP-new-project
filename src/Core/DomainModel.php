<?php

namespace John\Fun\Core;

interface DomainModel{
    public function getId(): DomainModelId;
}