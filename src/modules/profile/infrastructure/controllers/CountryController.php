<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\CountryDto;
use Src\modules\profile\application\useCases\country\CountryCreate;
use Src\modules\profile\application\useCases\country\CountryDelete;
use Src\modules\profile\application\useCases\country\CountryGetAll;
use Src\modules\profile\application\useCases\country\CountryGetOneById;
use Src\modules\profile\application\useCases\country\CountryUpdate;
use Src\modules\profile\infrastructure\dtos\countryDtoHttpResponse\CountryDtoHttp;
use Src\modules\profile\infrastructure\validators\country\CreateCountryRequest;
use Src\modules\profile\infrastructure\validators\country\DeleteCountryRequest;
use Src\modules\profile\infrastructure\validators\country\GetAllCountriesRequest;
use Src\modules\profile\infrastructure\validators\country\GetByIdCountryRequest;
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
            $request->state
        );

        $this->countryCreate->run($country);

        return $this->created([], "País creado exitosamente");
    }
    public function updateCountry(Request $request)
    {
        $country = new CountryDto(
            $request->name,
            $request->abbreviation,
            $request->code,
            $request->state,
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

        $countriesCollection = $this->countryGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => CountryDtoHttp::fromEntity($item), $countriesCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $countriesCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deleteCountry(DeleteCountryRequest $request)
    {
        $this->countryDelete->run($request->id);

        return $this->success([], "Registro de país borrado exitosamente");
    }
}
