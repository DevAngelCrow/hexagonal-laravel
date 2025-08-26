<?php

namespace Src\modules\profile\application\useCases\gender;

use Src\modules\profile\application\dtos\GenderDto;
use Src\modules\profile\domain\entities\gender\Gender;
use Src\modules\profile\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\profile\domain\value_objects\gender_value_object\GenderName;

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