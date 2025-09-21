<?php

namespace Src\modules\catalogs\infrastructure\implementation\GenderRepositoryImplementation;

use App\Models\CtlGender;
use Exception;
use Src\modules\catalogs\domain\entities\gender\Gender;
use Src\modules\catalogs\domain\repositories\gender\GenderRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderId;
use Src\modules\catalogs\domain\value_objects\gender_value_object\GenderName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplGenderRepository implements GenderRepositoryInterface
{
    private array $genderArray;
    public function create(Gender $gender): void
    {
        try {
            $genderModel = new CtlGender;
            $genderModel->name = $gender->getName()->value();
            // $genderModel->current = true;
            $genderModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Gender $gender): void
    {
        try {


            $genderModel = CtlGender::find($gender->getId()->value());
            if (!$genderModel) {
                throw new InfrastructureException("Genero no encontrado", Response::HTTP_NOT_FOUND);
            }
            $genderModel->name = $gender->getName()->value();
            $genderModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAll(?int $page, ?int $per_page): array
    {
        try {
            
            $query = CtlGender::select('id', 'name')->orderBy('id');

            if ($page !== null && $per_page !== null) {
                $genders = $query->paginate($per_page);

                $data = array_map(fn($gender) => $this->mapToDomain($gender), $genders->items());

                $this->genderArray = [
                    'data' => $data,
                    'pagination' => [
                        'total' => $genders->total(),
                        'current_page' => $genders->currentPage(),
                        'last_page' => $genders->lastPage(),
                        'per_page' => $genders->perPage(),
                    ]
                ];

                return $this->genderArray;
            }

            $genders = $query->get();
            $this->genderArray = array_map(fn($gender) => $this->mapToDomain($gender), $genders->all());
            
            return $this->genderArray;
        } catch (Exception $e) {

            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOneById(GenderId $id): ?Gender
    {
        try {
            $genderDb = CtlGender::where("id", $id->value())->first();
            if (!$genderDb) {
                throw new InfrastructureException("Genero no encontrado", Response::HTTP_NOT_FOUND);
            }

            $gender = $this->mapToDomain($genderDb);
            return $gender;
        } catch (\Throwable $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete(GenderId $id): void
    {
        try {
            $gender = CtlGender::find($id->value());

            $gender->current = false;
            $gender->save();
            $gender->delete();
        } catch (\Throwable $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(CtlGender $genderModel): Gender
    {
        return new Gender(
            new GenderName($genderModel->name),
            new GenderId($genderModel->id),
        );
    }
}
