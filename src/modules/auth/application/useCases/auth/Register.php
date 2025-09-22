<?php

namespace Src\modules\auth\application\useCases\auth;

use Src\modules\auth\application\useCases\dtos\RegisterDto;
use Src\modules\auth\application\useCases\dtos\UserDto;
use Src\modules\auth\application\useCases\user\UserCreate;
use Src\modules\profile\application\dtos\AddressDto;
use Src\modules\profile\application\dtos\DocumentDto;
use Src\modules\profile\application\dtos\PeopleDto;
use Src\modules\profile\application\services\address\AddressCreateService;
use Src\modules\profile\application\services\document\DocumentCreateService;
use Src\modules\profile\application\services\people\PeopleCreateService;
use Src\modules\security\application\dtos\UserRoleDto;
use Src\modules\security\application\services\user_role\UserRoleCreateService;
use Src\modules\storage\application\dtos\StorageFilesDto;
use Src\modules\storage\application\services\storageFiles\StorageFilesUploadService;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\repositories\UnitOfWorkTransactionDbInterface;

class Register
{
    private readonly UserCreate $userCreate;
    private readonly PeopleCreateService $peopleCreateService;
    private readonly AddressCreateService $addressCreateService;
    private readonly DocumentCreateService $documentCreateService;
    private readonly StorageFilesUploadService $storageFilesUploadService;
    private readonly UnitOfWorkTransactionDbInterface $transaction;
    private readonly UserRoleCreateService $userRoleCreateService;


    public function __construct(
        UserCreate $user_create,
        PeopleCreateService $people_create_service,
        AddressCreateService $address_create_service,
        documentCreateService $document_create_service,
        StorageFilesUploadService $storage_files_upload_service,
        UserRoleCreateService $user_role_create_service,
        UnitOfWorkTransactionDbInterface $transaction_db
    ) {
        $this->userCreate = $user_create;
        $this->peopleCreateService = $people_create_service;
        $this->addressCreateService = $address_create_service;
        $this->documentCreateService = $document_create_service;
        $this->storageFilesUploadService = $storage_files_upload_service;
        $this->transaction = $transaction_db;
        $this->userRoleCreateService = $user_role_create_service;
    }

    public function run(
        RegisterDto $registerDto, string $providerStorageCode
    ) {
        try{
            $this->transaction->beginTransaction();

        $storageFileDto = new StorageFilesDto(
            $registerDto->fileImg,
        );

        $storageFiles = $this->storageFilesUploadService->createImgForUser($storageFileDto, $providerStorageCode);

        $peopleDto = new PeopleDto(
            $registerDto->first_name,
            $registerDto->middle_name,
            $registerDto->last_name,
            $registerDto->birthdate,
            $registerDto->email,
            $registerDto->id_gender,
            $registerDto->id_marital_status,
            $registerDto->phone,
            $storageFiles->getPath()->value(),
            $registerDto->id_status,
            $registerDto->nationalities,
        );

        $person = $this->peopleCreateService->createPersonForUser(
            $peopleDto
        );

        $addressDto = new AddressDto(
            $registerDto->street,
            $registerDto->street_number,
            $registerDto->neighborhood,
            $registerDto->id_district,
            $registerDto->house_number,
            $registerDto->block,
            $registerDto->pathway,
            $registerDto->current,
            $person->getId()->value(),
            $registerDto->activeAddress
        );

        $this->addressCreateService->createAddressForUser($addressDto);

        $documentDto = new DocumentDto(
            (int)$registerDto->id_type_document,
            $person->getId()->value(),
            $registerDto->description,
            $registerDto->document_number,
            $registerDto->active
        );

        $this->documentCreateService->createDocumentForUser($documentDto);

        $userDto = new UserDto(
            $person->getId()->value(),
            $registerDto->user_name,
            $registerDto->password,
            $registerDto->id_status_user,
            $registerDto->last_access,
            $registerDto->is_validated
        );
        $user = $this->userCreate->run($userDto);

        $userRolDto = new UserRoleDto(
            $user->getId()->value(), [2]
        );

        $this->userRoleCreateService->userRoleCreateForUser($userRolDto);
        
        $this->transaction->commit();
        }catch(ApplicationException $error){
            $this->transaction->rollback();
        }
        
    }
}
