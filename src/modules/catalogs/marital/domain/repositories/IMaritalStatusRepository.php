<?php

namespace Src\modules\catalogs\marital\domain\repositories;

use Src\modules\catalogs\marital\domain\entities\MaritalStatusEntity;
use Src\modules\catalogs\marital\domain\value_objects\MaritalStatusId;

interface IMaritalStatusRepository
{
    public function findById(MaritalStatusId $id): ?MaritalStatusEntity;

    /**
     * Get all marital status entities.
     *
     * @return MaritalStatusEntity[]
     */
    public function findAll(): array;
    public function save(MaritalStatusEntity $entity): ?MaritalStatusEntity;
    public function delete(MaritalStatusId $id): void;
}
