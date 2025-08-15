<?php
namespace Src\modules\profile\application\useCases\gender;

use Src\modules\profile\domain\entities\gender\Gender;
use Src\modules\profile\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\profile\domain\value_objects\gender_value_object\GenderId;

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