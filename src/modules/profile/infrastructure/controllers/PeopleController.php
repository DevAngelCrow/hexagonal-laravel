<?php

namespace Src\modules\profile\infrastructure\controllers;


use Src\modules\profile\application\useCases\people\PeopleCreate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\people\PeopleGetOneByEmail;
use Src\modules\profile\application\useCases\people\PeopleGetOneById;
use Src\modules\profile\application\useCases\people\PeopleUpdate;
use Src\modules\profile\infrastructure\dtos\peopleDtoHttpResponse\PeopleDtoHttp;
use Src\shared\infrastructure\HttpResponses;

class PeopleController extends Controller
{
    use HttpResponses;
    protected PeopleCreate $peopleCreate;
    protected PeopleGetOneById $peopleGetOneById;
    protected PeopleGetOneByEmail $peopleGetOneByEmail;
    protected PeopleUpdate $peopleUpdate;

    public function __construct(PeopleCreate $people_create, PeopleGetOneById $people_get_one_by_id, 
    PeopleGetOneByEmail $people_get_one_by_email, PeopleUpdate $people_update)
    {
        $this->peopleCreate = $people_create;
        $this->peopleGetOneById = $people_get_one_by_id;
        $this->peopleGetOneByEmail = $people_get_one_by_email;
        $this->peopleUpdate = $people_update;
    }

    public function createPeople(Request $request)
    {

        //dd($request);

        $first_name = $request->first_name;
        $birthdate = new \DateTimeImmutable($request->birthdate);
        $id_gender = $request->id_gender;
        $email = $request->email;
        $id_marital_status = $request->id_marital_status;
        $phone = $request->phone;
        $id_status = $request->id_status;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $img_path = $request->img_path;
        $nationalities = $request->nationalities;


        $this->peopleCreate->run($first_name, $middle_name, $last_name, $birthdate, $id_gender, $email, $id_marital_status, $img_path, $phone, $id_status, $nationalities);

        return $this->created([], "Persona creada satisfactoriamente");
    }

    public function getOneByIdPeople(Request $request, int $id)
    {
        //dd($request);

        $person = $this->peopleGetOneById->run($id);

        return $this->success([
            "data" => PeopleDtoHttp::fromEntity($person),
        ], "Success");
    }

    public function getOneByEmail(Request $request, string $email)
    {
        $person = $this->peopleGetOneByEmail->run($email);

        return $this->success(["data" => PeopleDtoHttp::fromEntity($person), "Success"]);
    }

    public function updatePeople(Request $request)
    {
        $id = (int) $request->id;
        $first_name = $request->first_name;
        $birthdate = new \DateTimeImmutable($request->birthdate);
        $id_gender = (int) $request->id_gender;
        $email = $request->email;
        $id_marital_status = (int) $request->id_marital_status;
        $phone = $request->phone;
        $id_status = (int) $request->id_status;
        $middle_name = $request->middle_name;
        $last_name = $request->last_name;
        $img_path = $request->img_path;


        $this->peopleUpdate->run($id, $first_name, $middle_name, $last_name, $birthdate, $id_gender, $email, $id_marital_status, $img_path, $phone, $id_status);
        
        return $this->success([], "Registro de persona actualizado con éxito");
    
    }
}
