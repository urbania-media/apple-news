<?php

namespace Urbania\AppleNews\Contracts;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

interface Componentable extends JsonSerializable, Arrayable, Jsonable
{
    public function toComponent();
}
