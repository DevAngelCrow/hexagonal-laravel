<?php
namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusName;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusTableHeader;

class GlobalStatusGetOneByName
{
    private readonly GlobalStatusRepositoryInterface $globalStatusRepository;

    public function __construct(GlobalStatusRepositoryInterface $globalStatusRepository)
    {
        $this->globalStatusRepository = $globalStatusRepository;
    }

    public function run(string $name, string $table_header) : GlobalStatus
    {
        return $this->globalStatusRepository->getOneByName(new GlobalStatusName($name), new GlobalStatusTableHeader($table_header));
    }
}