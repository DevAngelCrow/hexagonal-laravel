<?php

namespace Src\modules\profile\application\useCases\gender;

use Src\modules\profile\domain\repositories\gender\GenderRepositoryInterface;

class GenderGetAll {
    private readonly GenderRepositoryInterface $genderRepository;

    public function __construct(GenderRepositoryInterface $gender_repository)
    {
        $this->genderRepository = $gender_repository;
    }

    public function run(?int $page, ?int $per_page) : array {

        return $this->genderRepository->getAll($page, $per_page);

    }
}