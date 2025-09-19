<?php

namespace Src\modules\catalogs\application\usesCases\globalStatus;

use Src\modules\catalogs\domain\repositories\GlobalStatusRepositoryInterface;

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

