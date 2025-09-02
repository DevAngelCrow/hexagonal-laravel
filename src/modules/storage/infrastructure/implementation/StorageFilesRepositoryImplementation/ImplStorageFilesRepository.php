<?php
namespace Src\modules\storage\infrastructure\implementation\StorageFilesRepositoryImplementation;

use App\Models\MntStorageFiles as StorageFilesModel;
use Exception;
use Illuminate\Container\Attributes\Auth;
use LogicException;
use Src\modules\storage\domain\entities\storageFiles\StorageFiles;
use Src\modules\storage\domain\repositories\storageFiles\StorageFilesRepositoryInterface;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFileContentFile;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesId;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesPath;
use Illuminate\Support\Str;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesActive;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesFileName;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdProvider;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesIdUser;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesMimeType;
use Src\modules\storage\domain\value_objects\storage_files_value_object\StorageFilesSize;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplStorageFilesRepository implements StorageFilesRepositoryInterface {
    private string $disk = "public";
    private string $basePath = "profile_img";
    public function upload(StorageFileContentFile $storageFiles, int $idProviderStorage): StorageFiles
    {
        try{
            $file = $storageFiles->value();
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($this->basePath, $filename, $this->disk);

            $user = auth()->user()->id;
            $storageFilesEntity = new StorageFiles(
                new StorageFilesFileName($filename),
                new StorageFilesIdProvider($idProviderStorage),
                new StorageFilesSize($file->getSize()),
                new StorageFilesMimeType($file->getClientMimeType()),
                new StorageFilesActive(true),
                new StorageFileContentFile(null),
                new StorageFilesPath($path),
                new StorageFilesIdUser($user)
            );

            return $storageFilesEntity;

        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }   
    public function download(StorageFilesId $id): StorageFiles
    {
        throw new LogicException("Método no implementado");
    }
    public function create(StorageFiles $storageFiles): void
    {
        try{
            $storageFileModel = new StorageFilesModel();

            $storageFileModel->filename = $storageFiles->getFilename()->value();
            $storageFileModel->path = $storageFiles->getPath()->value();
            $storageFileModel->id_provider = $storageFiles->getIdProvider()->value();
            $storageFileModel->size = $storageFiles->getSize()->value();
            $storageFileModel->mime_type = $storageFiles->getMimeType()->value();
            $storageFileModel->id_user = $storageFiles->getIdUser()->value();
            $storageFileModel->active = $storageFiles->getActive()->value();

            $storageFileModel->save();
        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getDataStorageFile(StorageFilesId $id): StorageFiles
    {
        throw new LogicException("Método no implementado");
    }
    public function delete(StorageFilesId $id): void
    {
        
    }
}