<?php

namespace Src\modules\profile\infrastructure\implementation\PeopleRepositoryImplementation;

use Exception;
use LogicException;
use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleId;
use App\Models\MntPeople as PeopleModel;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleBirthDate;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleFirstName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdGender;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdMaritalStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleImgPath;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleLastName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleMiddleName;
use Src\modules\profile\domain\value_objects\people_value_object\PeoplePhone;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplPeopleRepository implements PeopleRepositoryInterface
{
    public function create(People $person): ?People
    {
        try {
            //dd($person);

            $peopleModel = new PeopleModel;

            $peopleModel->first_name = $person->getFirstName()->value();
            $peopleModel->birthdate = $person->getBirthdate()->value();
            $peopleModel->id_gender = $person->getIdGender()->value();
            $peopleModel->email = $person->getEmail()->value();
            $peopleModel->id_marital_status = $person->getIdMaritalStatus()->value();
            $peopleModel->phone = $person->getPhone()->value();
            $peopleModel->id_status = $person->getIdStatus()->value();
            $peopleModel->middle_name = $person->getMiddleName()->value();
            $peopleModel->last_name = $person->getLastName()->value();
            $peopleModel->img_path = $person->getImgPath()->value();

            $peopleModel->save();

            return $this->mapToDomain($peopleModel);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(People $person): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    public function getAll(): array
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    public function getOneById(PeopleId $id): ?People
    {
        //try {
            $peopleModel = PeopleModel::where("id", $id->value())->first();

            if(!$peopleModel){
                throw new InfrastructureException("Registro de persona no encontrado", Response::HTTP_NOT_FOUND);
            }

            $person = $this->mapToDomain($peopleModel);

            return $person;
    }

    public function delete(PeopleId $id): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    private function mapToDomain(PeopleModel $people): People
    {
        //dd($people);
        return new People(
            new PeopleFirstName($people->first_name),
            new PeopleBirthDate($people->birthdate),
            new PeopleIdGender($people->id_gender),
            new PeopleEmail($people->email),
            new PeopleIdMaritalStatus($people->id_marital_status),
            new PeoplePhone($people->phone),
            new PeopleIdStatus($people->id_status),
            new PeopleMiddleName($people->middle_name),
            new PeopleLastName($people->last_name),
            new PeopleImgPath($people->img_path),
            new PeopleId($people->id)
        );
    }
}
