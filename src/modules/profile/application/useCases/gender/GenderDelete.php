<?php

namespace Src\modules\profile\application\useCases\gender;

use Src\modules\profile\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\profile\domain\value_objects\gender_value_object\GenderId;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class GenderDelete {
    private readonly GenderRepositoryInterface $genderRepository;

    public function __construct(GenderRepositoryInterface $gender_repository)
    {
        $this->genderRepository = $gender_repository;
    }

    public function run (int $id): void {
       $gender = $this->genderRepository->getOneById(new GenderId($id));

       if(!$gender) {
        throw new ApplicationException("Identificador de genero no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
       }
    }
}