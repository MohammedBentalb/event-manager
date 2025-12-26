<?php

namespace Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class OneToMany{
    public function __construct(public string $foreignKey, public string $tergetModel) {}
}