<?php
namespace Src\modules\catalogs\application\usesCases\gender;

use Src\modules\catalogs\application\dtos\GenderDto;
use Src\modules\catalogs\domain\entities\gender\Gender;
use Src\modules\catalogs\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderId;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderName;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class GenderUpdate {
    private GenderRepositoryInterface $genderRepository;

    public function __construct(
        GenderRepositoryInterface $gender_repository,
    ) {
        $this->genderRepository = $gender_repository;
    }

    public function run (GenderDto $gender): void {
        $idGender = new GenderId($gender->id);
        $genderDb = $this->genderRepository->getOneById($idGender);

        if(!$genderDb) {
            throw new ApplicationException("Identificador de genero no encontrado", HttpStatusCode::HTTP_NOT_FOUND->value);
        }

        $genderUpdate = new Gender(
            new GenderName ($gender->name),
            new GenderId ($gender->id)

        );

        $this->genderRepository->update($genderUpdate);
        
    }

  
}