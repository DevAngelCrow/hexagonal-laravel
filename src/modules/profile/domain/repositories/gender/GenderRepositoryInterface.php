<?php

namespace Src\modules\profile\domain\repositories\gender;

use Src\modules\profile\domain\entities\gender\Gender;
use Src\modules\profile\domain\value_objects\gender_value_object\GenderId;

interface GenderRepositoryInterface
{
    public function create(Gender $gender): void;
    public function update(Gender $gender): void;
    /**
     * @return Gender[];
     */

    public function getAll(int $page, int $per_page): array;
    public function getOneById(GenderId $id): ?Gender;
    public function delete(GenderId $id): void;
}