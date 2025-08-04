<?php

namespace Src\modules\profile\infrastructure\controllers;


use Src\modules\profile\application\useCases\people\PeopleCreate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\PeopleDto;
use Src\modules\profile\application\useCases\people\PeopleGetOneByEmail;
use Src\modules\profile\application\useCases\people\PeopleGetOneById;
use Src\modules\profile\application\useCases\people\PeopleUpdate;
use Src\modules\profile\infrastructure\dtos\peopleDtoHttpResponse\PeopleDtoHttp;
use Src\modules\profile\infrastructure\validators\people\CreatePeopleRequest;
use Src\modules\profile\infrastructure\validators\people\GetByEmailPeopleRequest;
use Src\modules\profile\infrastructure\validators\people\GetByIdPeopleRequest;
use Src\modules\profile\infrastructure\validators\people\UpdatePeopleRequest;
use Src\shared\infrastructure\HttpResponses;

class PeopleController extends Controller
{
    use HttpResponses;
    protected PeopleCreate $peopleCreate;
    protected PeopleGetOneById $peopleGetOneById;
    protected PeopleGetOneByEmail $peopleGetOneByEmail;
    protected PeopleUpdate $peopleUpdate;

    public function __construct(
        PeopleCreate $people_create,
        PeopleGetOneById $people_get_one_by_id,
        PeopleGetOneByEmail $people_get_one_by_email,
        PeopleUpdate $people_update
    ) {
        $this->peopleCreate = $people_create;
        $this->peopleGetOneById = $people_get_one_by_id;
        $this->peopleGetOneByEmail = $people_get_one_by_email;
        $this->peopleUpdate = $people_update;
    }

    public function createPeople(CreatePeopleRequest $request)
    {

        //dd($request);

        $person = new PeopleDto(
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            new \DateTimeImmutable($request->birthdate),
            $request->email,
            $request->id_gender,
            $request->id_marital_status,
            $request->phone,
            $request->img_path,
            $request->id_status,
            $request->nationalities
        );


        $this->peopleCreate->run($person);

        return $this->created([], "Persona creada satisfactoriamente");
    }

    public function getOneByIdPeople(GetByIdPeopleRequest $request)
    {
        //dd($request);

        $person = $this->peopleGetOneById->run($request->id);

        return $this->success([
            "data" => PeopleDtoHttp::fromEntity($person),
        ], "Success");
    }

    public function getOneByEmail(GetByEmailPeopleRequest $request)
    {
        $person = $this->peopleGetOneByEmail->run($request->email);

        return $this->success(["data" => PeopleDtoHttp::fromEntity($person), "Success"]);
    }

    public function updatePeople(UpdatePeopleRequest $request)
    {
        $person = new PeopleDto(
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            new \DateTimeImmutable($request->birthdate),
            $request->email,
            $request->id_gender,
            $request->id_marital_status,
            $request->phone,
            $request->img_path,
            $request->id_status,
            $request->nationalities,
            $request->id,
        );


        $this->peopleUpdate->run($person);

        return $this->success([], "Registro de persona actualizado con éxito");
    }
}
