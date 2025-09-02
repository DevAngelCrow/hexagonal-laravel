<?php

namespace Src\modules\storage\infrastructure\implementation\ProviderStorageRepositoryImplementation;

use App\Models\CtlProviderStorage as ProviderStorageModel;
use Exception;
use LogicException;
use Src\modules\storage\domain\entities\providerStorage\ProviderStorage;
use Src\modules\storage\domain\repositories\providerStorage\ProviderStorageRepositoryInterface;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageActive;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageCode;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageDescription;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageId;
use Src\modules\storage\domain\value_objects\provider_storage_value_object\ProviderStorageName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplProviderStoreRepository implements ProviderStorageRepositoryInterface
{
    private $providerStoreArray = [];
    public function create(ProviderStorage $providerStorage): void
    {
        try {

            $providerStorageModel = new ProviderStorageModel();

            $providerStorageModel->name = $providerStorage->getName()->value();
            $providerStorageModel->code = $providerStorage->getCode()->value();
            $providerStorageModel->description = $providerStorage->getDescription()->value();
            $providerStorageModel->active = $providerStorage->getActive()->value();


            $providerStorageModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(ProviderStorage $providerStorage): void
    {
        try {
            $providerStorageModel = ProviderStorageModel::find($providerStorage->getId()->value());

            $providerStorageModel->name = $providerStorage->getName()->value();
            $providerStorageModel->code = $providerStorage->getCode()->value();
            $providerStorageModel->description = $providerStorage->getDescription()->value();


            $providerStorageModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(int $page, int $per_page): array
    {
        try {
            $providerStorageModels = ProviderStorageModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $providerStorageModels->items());

            $this->providerStoreArray = [
                "data" => $data,
                "pagination" => [
                    "current_page" => $providerStorageModels->currentPage(),
                    "last_page" => $providerStorageModels->lastPage(),
                    "per_page" => $providerStorageModels->perPage(),
                    "total" => $providerStorageModels->total()
                ]
            ];

            return $this->providerStoreArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        throw new LogicException("Método no implementado");
    }
    public function getOneById(ProviderStorageId $id): ?ProviderStorage
    {
        try {
            $providerStorageModel = ProviderStorageModel::find($id->value());

            if (!$providerStorageModel) {
                throw new InfrastructureException("Identificador de proveedor de almacenamiento no encontrado");
            }

            $providerStorage = $this->mapToDomain($providerStorageModel);

            return $providerStorage;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        throw new LogicException("Método no implementado");
    }
    public function delete(ProviderStorageId $id): void
    {
        try {
            $providerStorageModel = ProviderStorageModel::find($id->value());

            $providerStorageModel->active = false;
            $providerStorageModel->save();
            $providerStorageModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneByCode(ProviderStorageCode $code): ?ProviderStorage
    {
        try{
            
            $providerStorageModel = ProviderStorageModel::where('code', $code->value())->first();
            
            if (!$providerStorageModel) {
                throw new InfrastructureException("Código de proveedor de almacenamiento no encontrado");
            }

            $providerStorage = $this->mapToDomain($providerStorageModel);

            return $providerStorage;

        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    private function mapToDomain(ProviderStorageModel $providerStorage): ProviderStorage
    {
        $providerStorageMapped = new ProviderStorage(
            new ProviderStorageName($providerStorage->name),
            new ProviderStorageCode($providerStorage->code),
            new ProviderStorageDescription($providerStorage->description),
            new ProviderStorageActive($providerStorage->active),
            new ProviderStorageId($providerStorage->id)
        );

        return $providerStorageMapped;
    }
}
