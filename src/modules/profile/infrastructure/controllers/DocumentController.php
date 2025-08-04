<?php
namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\DocumentDto;
use Src\modules\profile\application\useCases\document\DocumentCreate;
use Src\modules\profile\application\useCases\document\DocumentDelete;
use Src\modules\profile\application\useCases\document\DocumentGetAll;
use Src\modules\profile\application\useCases\document\DocumentGetOneById;
use Src\modules\profile\application\useCases\document\DocumentUpdate;
use Src\modules\profile\infrastructure\dtos\documentDtoHttpResponse\DocumentDtoHttp;
use Src\modules\profile\infrastructure\validators\documents\CreateDocumentRequest;
use Src\modules\profile\infrastructure\validators\documents\DeleteDocumentRequest;
use Src\modules\profile\infrastructure\validators\documents\GetAllDocumentRequest;
use Src\modules\profile\infrastructure\validators\documents\GetByIdDocumentRequest;
use Src\modules\profile\infrastructure\validators\documents\UpdateDocumentRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DocumentController extends Controller {
    use HttpResponses;
    protected DocumentCreate $documentCreate;
    protected DocumentUpdate $documentUpdate;
    protected DocumentGetOneById $documentGetOneById;
    protected DocumentGetAll $documentGetAll;
    protected DocumentDelete $documentDelete;

    public function __construct(DocumentCreate $document_create, DocumentUpdate $document_update,
    DocumentGetOneById $document_get_one_by_id, DocumentGetAll $document_get_all,
    DocumentDelete $documente_delete)
    {
        $this->documentCreate = $document_create;
        $this->documentUpdate = $document_update;
        $this->documentGetOneById = $document_get_one_by_id;
        $this->documentGetAll = $document_get_all;
        $this->documentDelete = $documente_delete;
    }

    public function createDocument (CreateDocumentRequest $request) {
        $document = new DocumentDto(
            (int) $request->id_type_document,
            (int) $request->id_people,
            $request->description,
            $request->document_number,
            $request->state
        );
        
        $this->documentCreate->run($document);

        return $this->created([], "Documento creado con éxito");
    }

    public function updateDocument(UpdateDocumentRequest $request){
        $document = new DocumentDto(
            (int) $request->id_type_document,
            (int) $request->id_people,
            $request->description,
            $request->document_number,
            $request->state,
            (int) $request->id
        );


        $this->documentUpdate->run($document);
        
        return $this->success([], "Documento actualizado con éxito");
    }

    public function getOneByIdDocument(GetByIdDocumentRequest $request){

        $document = $this->documentGetOneById->run($request->id);

        return $this->success(DocumentDtoHttp::fromEntity($document), "Success");
    }

    public function getAllDocuments(GetAllDocumentRequest $request){
        $page = (int) $request->query("page");
        $per_page = (int) $request->query("per_page");

        $documents = $this->documentGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => DocumentDtoHttp::fromEntity($item), $documents["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $documents["pagination"]);

        return $this->success($paginateData, "Success");

    }

    public function deleteDocument(DeleteDocumentRequest $request){

        $this->documentDelete->run($request->id);

        return $this->success([], "Documento eliminado satisfactoriamente");
    }
}