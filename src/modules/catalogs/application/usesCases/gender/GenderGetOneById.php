<?php
namespace Src\modules\catalogs\application\usesCases\gender;

use Src\modules\catalogs\domain\entities\gender\Gender;
use Src\modules\catalogs\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderId;

class GenderGetOneById {
    private readonly GenderRepositoryInterface $genderRepository;

    public function __construct(GenderRepositoryInterface $gender_repository)
    {
        $this->genderRepository = $gender_repository;
    }

    public function run (int $id): Gender {
        return $this->genderRepository->getOneById(new GenderId($id));
    }
}