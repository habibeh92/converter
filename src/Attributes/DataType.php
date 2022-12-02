<?php

namespace Habibeh92\Converter\Attributes;

use Attribute;

#[Attribute]
class DataType
{
    /**
     * DataType constructor.
     *
     * @param string      $field
     * @param string|null $type
     */
    public function __construct(public string $field, public ?string $type = null)
    {
    }
}
