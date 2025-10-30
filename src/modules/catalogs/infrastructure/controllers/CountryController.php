<?php

namespace Src\modules\catalogs\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\application\dtos\CountryDto;
use Src\modules\catalogs\application\usesCases\country\CountryCreate;
use Src\modules\catalogs\application\usesCases\country\CountryDelete;
use Src\modules\catalogs\application\usesCases\country\CountryGetAll;
use Src\modules\catalogs\application\usesCases\country\CountryGetOneById;
use Src\modules\catalogs\application\usesCases\country\CountryUpdate;
use Src\modules\catalogs\infrastructure\dtos\countryDtoHttpResponse\CountryDtoHttp;
use Src\modules\catalogs\infrastructure\validators\country\CreateCountryRequest;
use Src\modules\catalogs\infrastructure\validators\country\DeleteCountryRequest;
use Src\modules\catalogs\infrastructure\validators\country\GetAllCountriesRequest;
use Src\modules\catalogs\infrastructure\validators\country\GetByIdCountryRequest;
use Src\modules\catalogs\infrastructure\validators\country\UpdateCountryRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class CountryController extends Controller
{
    protected CountryCreate $countryCreate;
    protected CountryUpdate $countryUpdate;
    protected CountryGetAll $countryGetAll;
    protected CountryGetOneById $countryGetOneById;
    protected CountryDelete $countryDelete;

    use HttpResponses;

    public function __construct(
        CountryCreate $country_create,
        CountryUpdate $country_update,
        CountryGetAll $country_get_all,
        CountryGetOneById $country_get_one_by_id,
        CountryDelete $country_delete,
    ) {
        $this->countryCreate = $country_create;
        $this->countryUpdate = $country_update;
        $this->countryGetAll = $country_get_all;
        $this->countryGetOneById = $country_get_one_by_id;
        $this->countryDelete = $country_delete;
    }

    public function createCountry(CreateCountryRequest $request)
    {

        $country = new CountryDto(
            $request->name,
            $request->abbreviation,
            $request->code,
            $request->active
        );

        $this->countryCreate->run($country);

        return $this->created([], "País creado exitosamente");
    }
    public function updateCountry(UpdateCountryRequest $request)
    {
        $country = new CountryDto(
            $request->name,
            $request->abbreviation,
            $request->code,
            $request->active,
            (int) $request->id
        );

        $this->countryUpdate->run($country);

        return $this->success([], "País actualizado exitosamente");
    }
    public function getOneByIdCountry(GetByIdCountryRequest $request)
    {

        $country = $this->countryGetOneById->run($request->id);

        return $this->success(CountryDtoHttp::fromEntity($country), "Success");
    }
    public function getAllCountry(GetAllCountriesRequest $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");
        $filer_name = $request->query("filter_name");

        $countriesCollection = $this->countryGetAll->run($page, $per_page, $filer_name);
        if ($page !== null && $per_page !== null) {
            
            $collections = array_map(fn($item) => CountryDtoHttp::fromEntity($item), $countriesCollection["data"]);

            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $countriesCollection["pagination"]);

            return $this->success($paginateData, "Success");
        }

        $data = array_map(fn($item) => CountryDtoHttp::fromEntity($item), $countriesCollection);
        return $this->success($data, "Success");
    }
    public function deleteCountry(DeleteCountryRequest $request)
    {
        $this->countryDelete->run($request->id);

        return $this->success([], "Registro de país borrado exitosamente");
    }
}
