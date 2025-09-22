<?php

namespace Src\modules\catalogs\application\usesCases\gender;

use Src\modules\catalogs\application\dtos\GenderDto;
use Src\modules\catalogs\domain\entities\gender\Gender;
use Src\modules\catalogs\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderName;

class GenderCreate {
    private GenderRepositoryInterface $repository;

    public function __construct(
        GenderRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    public function run(
        GenderDto $gender
    ): void {
        $gender = new Gender(
            new GenderName($gender->name),
        );
        $this->repository->create($gender);
    }
}