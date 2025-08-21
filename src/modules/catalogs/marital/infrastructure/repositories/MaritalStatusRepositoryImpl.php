<?php

namespace Src\modules\catalogs\marital\infrastructure\repositories;

use App\Models\CtlMaritalStatus;
use Src\modules\catalogs\marital\domain\repositories\IMaritalStatusRepository;
use Src\modules\catalogs\marital\domain\entities\MaritalStatusEntity;
use Src\modules\catalogs\marital\domain\value_objects\MaritalStatusId;

class MaritalStatusRepositoryImpl implements IMaritalStatusRepository
{
    public function findById(MaritalStatusId $id): ?MaritalStatusEntity
    {

        return CtlMaritalStatus::find($id->value());
    }

    /**
     * Get all marital status entities.
     *
     * @return MaritalStatusEntity[]
     */
    public function findAll(): array
    {
        $data = CtlMaritalStatus::all();

        if ($data->isEmpty()) {
            return [];
        }

        return $data->map(
            fn($status) =>
            MaritalStatusEntity::reconstitute(
                $status->id,
                $status->name,
                $status->description
            )
        )->toArray();
    }

    public function save(MaritalStatusEntity $entity): ?MaritalStatusEntity
    {
        $status = CtlMaritalStatus::create([
            'name' => $entity->getName()->value(),
            'description' => $entity->getDescription()->value(),
        ]);

        if (!$status) {
            return null;
        }


        return MaritalStatusEntity::reconstitute(
            $status->id,
            $status->name,
            $status->description
        );
    }

    public function delete(MaritalStatusId $id): void
    {
        CtlMaritalStatus::destroy($id->value());
    }
}
