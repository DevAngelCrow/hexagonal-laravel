<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\profile\application\useCases\gender\GenderGetAll;
use Src\modules\profile\application\dtos\GenderDto;
use Src\modules\profile\application\useCases\gender\GenderCreate;
use Src\modules\profile\application\useCases\gender\GenderGetOneById;
use Src\modules\profile\application\useCases\gender\GenderUpdate;
use Src\modules\profile\infrastructure\dtos\genterDtoHttpResponse\GenderDtoHttp;
use Src\modules\profile\infrastructure\validators\gender\CreateGenderRequest;
use Src\modules\profile\infrastructure\validators\gender\GetAllGenderRequest;
use Src\modules\profile\infrastructure\validators\gender\GetByIdGenderRequest;
use Src\modules\profile\infrastructure\validators\gender\UpdateGenderRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class GenderController extends Controller 
{
    use HttpResponses;
    protected GenderCreate $genderCreate;
    protected GenderGetAll $genderGetAll;
    protected GenderGetOneById $genderGetOneById;
    protected GenderUpdate $genderUpdate;

    public function __construct(GenderCreate $genderCreate, GenderGetAll $genderGetAll, GenderGetOneById $genderGetOneById, GenderUpdate $genderUpdate)
    {
        $this->genderCreate = $genderCreate;
        $this->genderGetAll = $genderGetAll;
        $this->genderGetOneById = $genderGetOneById;
        $this->genderUpdate = $genderUpdate;
    }

    public function createGender(CreateGenderRequest $request)
    {
        $genderDto = new GenderDto(
            $request->name
        );
        $this->genderCreate->run($genderDto);
        return $this->created([], "Género creado satisfactoriamente");
    }

    public function updateGender(UpdateGenderRequest $request)
    {
        $genderDto = new GenderDto(
            $request->name,
            (int) $request->id,
        );
        $this->genderUpdate->run($genderDto);
        return $this->success([], "Género actualizado satisfactoriamente");
    }

    public function getAllGender(GetAllGenderRequest $request)
    {
        $gendersCollection = $this->genderGetAll->run($request->query('page'), $request->query('per_page'));

        $collection = array_map(fn($item) => GenderDtoHttp::fromEntity($item), $gendersCollection["data"]);
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collection, $gendersCollection['pagination']);
        return $this->success($paginateData, "Success");
    }

    public function getGenderById(GetByIdGenderRequest $request)
    {
        $gender = $this->genderGetOneById->run($request->id);

        return $this->success(GenderDtoHttp::fromEntity($gender), "Success");
    }

  
}

