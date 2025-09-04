<?php

namespace Src\modules\catalogs\marital\application\CreateMaritalUseCase;

use Src\modules\catalogs\marital\domain\entities\MaritalStatusEntity;
use Src\modules\catalogs\marital\domain\repositories\IMaritalStatusRepository;

class CreateMaritalUseCase
{
    public function __construct(
        private readonly IMaritalStatusRepository $repository
    ) {}

    public function run(CreateMaritalDto $createMaritalDto): MaritalStatusEntity
    {
        $maritalStatus = MaritalStatusEntity::create(
            $createMaritalDto->name,
            $createMaritalDto->description
        );

        return $this->repository->save($maritalStatus);
    }
}
