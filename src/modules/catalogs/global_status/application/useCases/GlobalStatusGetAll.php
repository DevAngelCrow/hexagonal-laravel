<?php

namespace Src\modules\catalogs\global_status\application\useCases;

use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\repositories\GlobalStatusRepositoryInterface;



class GlobalStatusGetAll {
    private GlobalStatusRepositoryInterface $globalStatusrepository;

    public function __construct(
        GlobalStatusRepositoryInterface $repository,
    ) {
        $this->globalStatusrepository = $repository;
    }

    public function run(
        ?int $page, ?int $per_page
    ): array {
        return $this->globalStatusrepository->getAll($page, $per_page);
    }
}

