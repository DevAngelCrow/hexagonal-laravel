<?php

namespace Src\modules\storage\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\application\useCases\storageFiles\StorageFilesCreate;
use Src\modules\storage\infrastructure\validators\storageFiles\UploadFileRequest;
use Src\shared\infrastructure\HttpResponses;

class StorageFilesController extends Controller
{
    use HttpResponses;
    protected readonly StorageFilesCreate $storageFilesCreate;

    public function __construct(StorageFilesCreate $storage_files_create)
    {
        $this->storageFilesCreate = $storage_files_create;
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $file = new StorageFilesDto(
            $request->content_files,
            $request->filename,
            $request->id_provider,
            $request->size,
            $request->mime_type,
            $request->active,
            $request->path,
            $request->id_user,
        );

        $provider = config('storage.provider_code');

        $this->storageFilesCreate->run($file, $provider);

        return $this->success([], "Imagen almacenada satisfactoriamente");
    }
}
