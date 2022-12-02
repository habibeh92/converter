<?php

namespace Habibeh92\Converter\Tests\Feature\Entities;

use Habibeh92\Converter\Attributes\DataType;

class Data
{
    #[DataType(field: 'data', type: Ticker::class)]
    public array $data;
}
