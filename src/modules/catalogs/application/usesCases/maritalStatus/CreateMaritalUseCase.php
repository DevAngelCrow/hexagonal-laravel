<?php

namespace Src\modules\catalogs\application\usesCases\maritalStatus;

use Src\modules\catalogs\application\dtos\CreateMaritalDto;
use Src\modules\catalogs\domain\entities\MaritalStatusEntity;
use Src\modules\catalogs\domain\repositories\IMaritalStatusRepository;

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
