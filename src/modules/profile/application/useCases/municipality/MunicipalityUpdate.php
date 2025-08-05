<?php
namespace Src\modules\profile\application\useCases\municipality;

use Src\modules\profile\application\dtos\MunicipalityDto;
use Src\modules\profile\domain\entities\municipality\Municipality;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityActive;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityId;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityName;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class MunicipalityUpdate {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(MunicipalityDto $municipalityDto) : void {
        
        $municipalityDb = $this->municipalityRepository->getOneById(new MunicipalityId($municipalityDto->id));

        if(!$municipalityDb){
            throw new ApplicationException("Identificador del municipio no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $municipality = new Municipality(
            new MunicipalityName($municipalityDto->name),
            new MunicipalityDescription($municipalityDto->description),
            new MunicipalityIdDepartment($municipalityDto->id_department),
            new MunicipalityActive($municipalityDto->active),
            $municipalityDb->getId(),
        );

        $this->municipalityRepository->update($municipality);
    }
}