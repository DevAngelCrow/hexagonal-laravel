<?php
namespace Src\modules\catalogs\application\usesCases\maritalStatus;

use Src\modules\catalogs\domain\repositories\IMaritalStatusRepository;

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
