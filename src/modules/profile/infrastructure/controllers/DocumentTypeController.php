<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\profile\application\dtos\DocumentTypeDto;
use Src\modules\profile\application\useCases\documentType\DocumentTypeGetAll;
use Src\modules\profile\application\useCases\documentType\DocumentTypeCreate;
use Src\modules\profile\application\useCases\documentType\DocumentTypeGetOneById;
use Src\modules\profile\application\useCases\documentType\DocumentTypeUpdate;
use Src\modules\profile\application\useCases\documentType\DocumentTypeDelete;
use Src\modules\profile\infrastructure\dtos\documentTypeDtoHttpResponse\DocumentTypeDtoHttp;
use Src\modules\profile\infrastructure\validators\documentType\CreateDocumentTypeRequest;
use Src\modules\profile\infrastructure\validators\documentType\GetAllDocumentTypeRequest;
use Src\modules\profile\infrastructure\validators\documentType\GetByIdDocumentTypeRequest;
use Src\modules\profile\infrastructure\validators\documentType\UpdateDocumentTypeRequest;
use Src\modules\profile\infrastructure\validators\documentType\DeleteDocumentTypeRequest;


use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DocumentTypeController extends Controller
{
    use HttpResponses;
    protected DocumentTypeCreate $documentCreate;
    protected DocumentTypeGetAll $documentGetAll;
    protected DocumentTypeGetOneById $documentGetOneById;
    protected DocumentTypeUpdate $documentUpdate;

    protected DocumentTypeDelete $documentTypeDelete;

    public function __construct(
        DocumentTypeCreate $document_create,
        DocumentTypeGetAll $document_get_all,
        DocumentTypeGetOneById $document_get_one_by_id,
        DocumentTypeUpdate $document_update
    ) {
        $this->documentCreate = $document_create;
        $this->documentGetAll = $document_get_all;
        $this->documentGetOneById = $document_get_one_by_id;
        $this->documentUpdate = $document_update;
    }

    public function createDocumentType(CreateDocumentTypeRequest $request)
    {
        $documentDto = new DocumentTypeDto(
            $request->name,
            $request->description,
            $request->active,
            $request->mask,
        );

        $this->documentCreate->run($documentDto);
        return $this->created([], "Tipo de Documento creado satisfactoriamente");
    }

    public function updateDocumentType(UpdateDocumentTypeRequest $request)
    {

        $documentDto = new DocumentTypeDto(
            $request->name,
            $request->description,
            $request->active,
            $request->mask,
            (int) $request->id,
        );
        $this->documentUpdate->run($documentDto);

        return $this->success([], "Tipo de Documento actualizado con éxito");
    }
    public function getAllDocumentType(GetAllDocumentTypeRequest $request)
    {


        $documentCollection = $this->documentGetAll->run($request->query('page'), $request->query('per_page'));
        //dd($documentCollection);
        if ($request->query("page") !== null &&  $request->query("per_page") !== null ) {
            $collections = array_map(fn($item) => DocumentTypeDtoHttp::fromEntity($item), $documentCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $documentCollection["pagination"]);
            return $this->success($paginateData, "Success");
        }

        $data = array_map(fn($item) => DocumentTypeDtoHttp::fromEntity($item), $documentCollection);
        return $this->success($data, "Success");
    }

    public function getOneByIdDocumentType(GetByIdDocumentTypeRequest $request)
    {


        $document = $this->documentGetOneById->run($request->id);


        return $this->success(DocumentTypeDtoHttp::fromEntity($document), "Success");
    }
    public function deleteDocumentType(DeleteDocumentTypeRequest $request)
    {
        $this->documentTypeDelete->run($request->id);

        return $this->success([], "Registro de tipo de documento borrado exitosamente");
    }
}
