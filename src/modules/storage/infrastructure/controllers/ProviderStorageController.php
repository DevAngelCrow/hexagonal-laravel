<?php

namespace Src\modules\storage\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageCreate;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageDelete;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageGetAll;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageGetOneById;
use Src\modules\storage\application\useCases\providerStorage\ProviderStorageUpdate;

class ProviderStorageController extends Controller
{
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

    
}
