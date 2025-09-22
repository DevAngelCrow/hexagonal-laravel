<?php

namespace Src\modules\catalogs\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\application\dtos\GenderDto;
use Src\modules\catalogs\application\usesCases\gender\GenderCreate;
use Src\modules\catalogs\application\usesCases\gender\GenderGetAll;
use Src\modules\catalogs\application\usesCases\gender\GenderGetOneById;
use Src\modules\catalogs\application\usesCases\gender\GenderUpdate;
use Src\modules\catalogs\infrastructure\dtos\genterDtoHttpResponse\GenderDtoHttp;
use Src\modules\catalogs\infrastructure\validators\gender\CreateGenderRequest;
use Src\modules\catalogs\infrastructure\validators\gender\GetAllGenderRequest;
use Src\modules\catalogs\infrastructure\validators\gender\GetByIdGenderRequest;
use Src\modules\catalogs\infrastructure\validators\gender\UpdateGenderRequest;
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
         $page = $request->query("page");
        $per_page = $request->query("per_page");

        $gendersCollection = $this->genderGetAll->run($page, $per_page);

        if($page !== null && $per_page !== null){
            $collection = array_map(fn($item) => GenderDtoHttp::fromEntity($item), $gendersCollection["data"]);
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collection, $gendersCollection['pagination']);
        return $this->success($paginateData, "Success");
        }

        $data = array_map(fn($item) => GenderDtoHttp::fromEntity($item), $gendersCollection);
        return $this->success($data, "Success");
        
    }

    public function getGenderById(GetByIdGenderRequest $request)
    {
        $gender = $this->genderGetOneById->run($request->id);

        return $this->success(GenderDtoHttp::fromEntity($gender), "Success");
    }

  
}

