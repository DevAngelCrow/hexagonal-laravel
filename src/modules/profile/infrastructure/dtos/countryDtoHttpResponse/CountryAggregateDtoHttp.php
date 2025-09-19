<?php
// namespace Src\modules\profile\infrastructure\dtos\countryDtoHttpResponse;

// use Src\modules\profile\domain\aggregate\department\DepartmentWithCountry;

// class MunicipalityAggregateDtoHttp {
//     public function __construct(public readonly DepartmentWithCountry $departmentWithCountry)
//     {
        
//     }
//     public static function fromAggregate(DepartmentWithCountry $departmentWithCountry) : self{
//         return new self($departmentWithCountry);
//     }
//     public function toArray() : array {
//         $country = $this->departmentWithCountry->getCountry();
//         $department = $this->departmentWithCountry->getDepartment();
//         $departmentMappedData = [
//             "id" => $department->getId()->value(),
//             "name" => $department->getName()->value(),
//             "description" => $department->getDescription()->value(),
//             "active" => $department->getActive()->value()
//         ];
//         $countryMappedData = [
//             "name" => $country->getName()->value(),
//             "abbreviation" => $country->getAbbreviation()->value(),
//             "code" => $country->getCode()->value(),
//             "active" => $country->getActive()->value()
//         ];

//         $departmentMappedData["country"] = $countryMappedData;
        
//         return $departmentMappedData;
//     }
// }