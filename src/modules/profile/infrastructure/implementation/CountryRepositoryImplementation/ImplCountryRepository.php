<?php

namespace Src\modules\profile\infrastructure\implementation\CountryRepositoryImplementation;

use App\Models\CtlCountry as CountryModel;
use Exception;
use LogicException;
use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\profile\domain\value_objects\country_value_object\CountryCode;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
use Src\modules\profile\domain\value_objects\country_value_object\CountryName;
use Src\modules\profile\domain\value_objects\country_value_object\CountryState;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplCountryRepository implements CountryRepositoryInterface
{
    private $countriesArray = [];
    public function create(Country $country): void
    {
        try {
            $countryModel = new CountryModel;

            $countryModel->name = $country->getName()->value();
            $countryModel->abbreviation = $country->getAbbreviation()->value();
            $countryModel->code = $country->getCode()->value();
            $countryModel->state = $country->getState()->value();

            $countryModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Country $country): void
    {
        try {
            $countryModel = CountryModel::find($country->getId()->value());

            $countryModel->name = $country->getName()->value();
            $countryModel->abbreviation = $country->getAbbreviation()->value();
            $countryModel->code = $country->getCode()->value();
            $countryModel->state = $country->getState()->value();

            $countryModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(CountryId $id): ?Country
    {
        try {
            $countryModel = CountryModel::find($id->value());

            if (!$countryModel) {
                throw new InfrastructureException("Identificador de país no encontrado en los registros", Response::HTTP_NOT_FOUND);
            }

            $country = $this->mapToDomain($countryModel);

            return $country;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(int $page, int $per_page): array
    {
        try {
            $countriesModels = CountryModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $countriesModels->items());
            $this->countriesArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $countriesModels->currentPage(),
                    'last_page' => $countriesModels->lastPage(),
                    'per_page' => $countriesModels->perPage(),
                    'total' => $countriesModels->total(),
                ]
            ];

            return $this->countriesArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(CountryId $id): void
    {
        try {
            $countryModel = CountryModel::find($id->value());

            $countryModel->state = false;
            $countryModel->save();
            $countryModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(CountryModel $country)
    {
        $countryMapped = new Country(
            new CountryName($country->name),
            new CountryAbbreviation($country->abbreviation),
            new CountryCode($country->code),
            new CountryState($country->state),
            new CountryId($country->id)
        );

        return $countryMapped;
    }
}
