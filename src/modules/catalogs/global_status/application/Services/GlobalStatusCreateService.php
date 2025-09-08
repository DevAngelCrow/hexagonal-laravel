<?php

namespace Src\modules\catalogs\global_status\application\services;

use Src\modules\catalogs\global_status\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusCreate;

class GlobalStatusCreateService
{
    private readonly GlobalStatusCreate $globalStatusCreate;

    public function __construct(GlobalStatusCreate $globalStatus_create)
    {
        $this->globalStatusCreate = $globalStatus_create;
    }

    public function createGlobalStatusForUser(
        GlobalStatusDto $globalStatusDto
    ) {

        $globalStatus = $this->globalStatusCreate->run(
            $globalStatusDto
        );

        return $globalStatus;
    }
}
