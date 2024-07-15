<?php

namespace John\Fun\Core;

class Drug implements  DomainModel
{
    private DomainModelId $id;

    use IdTrait;
}