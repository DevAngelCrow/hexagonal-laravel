<?php
namespace Src\modules\catalogs\application\services\globalStatus;

use Src\modules\catalogs\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusCreate;

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
