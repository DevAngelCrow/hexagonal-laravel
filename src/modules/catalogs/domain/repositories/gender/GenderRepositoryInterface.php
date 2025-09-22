<?php
namespace Src\modules\catalogs\domain\repositories\gender;

use Src\modules\catalogs\domain\entities\gender\Gender;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderId;

interface GenderRepositoryInterface
{
    public function create(Gender $gender): void;
    public function update(Gender $gender): void;
    /**
     * @return Gender[];
     */

    public function getAll(?int $page, ?int $per_page): array;
    public function getOneById(GenderId $id): ?Gender;
    public function delete(GenderId $id): void;
}