<?php

namespace Src\modules\storage\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\storage\application\dtos\ProviderStorageDto;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageCreate;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageDelete;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageGetAll;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageGetOneById;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageUpdate;
use Src\modules\storage\infrastructure\dtos\providerStorageDtoHttpResponse\ProviderStorageDtoHttp;
use Src\modules\storage\infrastructure\validators\providerStorage\CreateProviderStorageRequest;
use Src\modules\storage\infrastructure\validators\providerStorage\DeleteProviderStorageRequest;
use Src\modules\storage\infrastructure\validators\providerStorage\GetAllProviderStorageRequest;
use Src\modules\storage\infrastructure\validators\providerStorage\GetByIdProviderStorageRequest;
use Src\modules\storage\infrastructure\validators\providerStorage\UpdateProviderStorageRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class ProviderStorageController extends Controller
{
    use HttpResponses;
    private readonly ProviderStorageCreate $providerStorageCreate;
    private readonly ProviderStorageUpdate $providerStorageUpdate;
    private readonly ProviderStorageGetAll $providerStorageGetAll;
    private readonly ProviderStorageGetOneById $providerStorageGetOneById;
    private readonly ProviderStorageDelete $providerStorageDelete;

    public function __construct(ProviderStorageCreate $provider_storage_create, 
    ProviderStorageUpdate $provider_storage_update, 
    ProviderStorageGetAll $provider_storage_get_all, 
    ProviderStorageGetOneById $provider_storage_get_one_by_id, 
    ProviderStorageDelete $provider_storage_delete) {
        $this->providerStorageCreate = $provider_storage_create;
        $this->providerStorageUpdate = $provider_storage_update;
        $this->providerStorageGetAll = $provider_storage_get_all;
        $this->providerStorageGetOneById = $provider_storage_get_one_by_id;
        $this->providerStorageDelete = $provider_storage_delete;
    }

    public function createProviderStorage(CreateProviderStorageRequest $request){
        $providerStorage = new ProviderStorageDto(
            $request->name,
            $request->code,
            $request->description,
            $request->active,
        );

        $this->providerStorageCreate->run($providerStorage);

        return $this->created([], "Proveedor de almacenamiento creado satisfactoriamente");
    }
    public function updateProviderStorage(UpdateProviderStorageRequest $request){
        $providerStorageUpdate = new ProviderStorageDto(
            $request->name,
            $request->code,
            $request->description,
            $request->active,
            $request->id
        );

        $this->providerStorageUpdate->run($providerStorageUpdate);

        return $this->success([], "Proveedor de almacenamiento actualizado satisfactoriamente");
    }
    public function getAllProviderStorage(GetAllProviderStorageRequest $request){
        $providerStorageCollection = $this->providerStorageGetAll->run($request->query('page'), $request->query('per_page'));

        $collections = array_map(fn($item)=> ProviderStorageDtoHttp::fromEntity($item), $providerStorageCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $providerStorageCollection['pagination']);

        return $this->success($paginateData, "Success");
    }
    public function getOneByIdProviderStorage(GetByIdProviderStorageRequest $request){
        $providerStorage = $this->providerStorageGetOneById->run($request->id);

        return $this->success(["data"=> ProviderStorageDtoHttp::fromEntity($providerStorage)]);
    }
    public function deleteProviderStorage(DeleteProviderStorageRequest $request){
         $this->providerStorageGetOneById->run($request->id);

         return $this->success([], "Registro eliminado satisfactoriamente");

    }
}
