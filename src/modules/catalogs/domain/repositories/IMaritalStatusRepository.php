<?php

namespace Src\modules\catalogs\domain\repositories;

use Src\modules\catalogs\domain\entities\MaritalStatusEntity;
use Src\modules\catalogs\domain\value_objects\marital_status_value_objects\MaritalStatusId;

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
