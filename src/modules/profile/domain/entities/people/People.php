<?php

namespace Src\modules\profile\domain\entities\people;

use Src\modules\profile\domain\exceptions\PeopleException;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleBirthDate;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleFirstName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleId;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdGender;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdMaritalStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleImgPath;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleLastName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleMiddleName;
use Src\modules\profile\domain\value_objects\people_value_object\PeoplePhone;
class People
{
    private readonly  PeopleFirstName $first_name;
    private readonly  PeopleBirthdate $birthdate;
    private readonly  PeopleIdGender $id_gender;
    private readonly  PeopleEmail $email;
    private readonly  PeopleIdMaritalStatus $id_marital_status;
    private readonly  PeoplePhone $phone;
    private readonly  PeopleIdStatus $id_status;
    private readonly  PeopleMiddleName $middle_name;
    private readonly  PeopleLastName $last_name;
    private readonly  PeopleImgPath $img_path;
    /** @var CountryId[] */
    private readonly  ?array $countriesId;
    private readonly  ?PeopleId $id;

    public function __construct(
        PeopleFirstName $first_name,
        PeopleBirthdate $birthdate,
        PeopleIdGender $id_gender,
        PeopleEmail $email,
        PeopleIdMaritalStatus $id_marital_status,
        PeoplePhone $phone,
        PeopleIdStatus $id_status,
        PeopleMiddleName $middle_name,
        PeopleLastName $last_name,
        PeopleImgPath $img_path,
        ?PeopleId $id = null,
        ?array $countriesId = null,
    ) {
        $this->first_name = $first_name;
        $this->birthdate = $birthdate;
        $this->id_gender = $id_gender;
        $this->email = $email;
        $this->id_marital_status = $id_marital_status;
        $this->phone = $phone;
        $this->id_status = $id_status;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->img_path = $img_path;
        $this->countriesId = $countriesId;
        $this->id = $id;

        if(!empty($countriesId)){
            foreach($this->countriesId as $countryId){
            if(!$countryId instanceof CountryId){
                throw new PeopleException("La instancia de cada elemento debe ser de tipo CountryId");
            }
        }
        }
    }

    public function getFirstName(): PeopleFirstName
    {
        return $this->first_name;
    }

    public function getBirthdate(): PeopleBirthdate
    {
        return $this->birthdate;
    }

    public function getIdGender(): PeopleIdGender
    {
        return $this->id_gender;
    }

    public function getEmail(): PeopleEmail
    {
        return $this->email;
    }

    public function getIdMaritalStatus(): PeopleIdMaritalStatus
    {
        return $this->id_marital_status;
    }

    public function getPhone(): PeoplePhone
    {
        return $this->phone;
    }

    public function getIdStatus(): PeopleIdStatus
    {
        return $this->id_status;
    }

    public function getMiddleName(): PeopleMiddleName
    {
        return $this->middle_name;
    }

    public function getLastName(): PeopleLastName
    {
        return $this->last_name;
    }

    public function getImgPath(): PeopleImgPath
    {
        return $this->img_path;
    }

    public function getId(): ?PeopleId
    {
        return $this->id;
    }

    public function getCountries() : array {
        return $this->countriesId;
    }

}
