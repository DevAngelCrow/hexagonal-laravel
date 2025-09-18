<?php

namespace Src\modules\catalogs\domain\value_objects\global_status_value_objects;


class GlobalStatusTableHeader
{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
    }


    public function value() : string {
        return $this->value;
    }
}
