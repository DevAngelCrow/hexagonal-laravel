<?php

namespace Src\modules\catalogs\marital\application\ListMaritalUseCase;

use Src\modules\catalogs\marital\domain\repositories\IMaritalStatusRepository;

class ListMaritalUseCase
{
    public function __construct(
        private readonly IMaritalStatusRepository $repository
    ) {}

    public function run(): array
    {
        //TODO: Add pagination and filtering

        return $this->repository->findAll();
    }
}
