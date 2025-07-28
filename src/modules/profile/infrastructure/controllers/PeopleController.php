<?php
namespace Src\modules\profile\infrastructure\controllers;


use Src\modules\profile\application\useCases\people\PeopleCreate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\people\PeopleGetOneById;
use Src\modules\profile\infrastructure\dtos\peopleDtoHttpResponse\PeopleDtoHttp;
use Src\shared\infrastructure\HttpResponses;

class PeopleController extends Controller{
    use HttpResponses;
    protected PeopleCreate $peopleCreate;
    protected PeopleGetOneById $peopleGetOneById;

    public function __construct(PeopleCreate $people_create, PeopleGetOneById $people_get_one_by_id)
    {
        $this->peopleCreate = $people_create;
        $this->peopleGetOneById = $people_get_one_by_id;
    }

    public function createPeople(Request $request){

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

        //dd($birthdate);
        $this->peopleCreate->run($first_name, $middle_name, $last_name, $birthdate, $id_gender, $email, $id_marital_status, $img_path, $phone, $id_status);

        return $this->created([], "Persona creada satisfactoriamente");
    }

    public function getOneByIdPeople(Request $request, int $id){
        //dd($request);
        
        $person = $this->peopleGetOneById->run($id);
        
        return $this->success([
            "data" => PeopleDtoHttp::fromEntity($person),
        ], "Success");
    }
}