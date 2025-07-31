<?php

namespace Src\modules\profile\infrastructure\implementation\DocumentRepositoryImplementation;

use App\Models\MntDocument as DocumentModel;
use Exception;
use Src\modules\profile\domain\entities\documents\Document;
use Src\modules\profile\domain\repositories\documents\DocumentRepositoryInterface;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentId;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentIdPeople;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentIdTypeDocument;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentDescription;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentNumberDoc;
use Src\modules\profile\domain\value_objects\document_value_object\DocumentState;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplDocumentRepository implements DocumentRepositoryInterface
{
    private array $documentsArray = [];
    public function create(Document $document): void
    {
        try {

            $documentModel = new DocumentModel;

            $documentModel->id_type_document = $document->getIdTypeDocument()->value();
            $documentModel->id_people = $document->getIdPeople()->value();
            $documentModel->description = $document->getDescription()->value();
            $documentModel->state = $document->getState()->value();
            $documentModel->document_number = $document->getNumberDocument()->value();

            $documentModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Document $document): void
    {
        try {

            $documentModel = DocumentModel::find($document->getId()->value());

            $documentModel->id_type_document = $document->getIdTypeDocument()->value();
            $documentModel->id_people = $document->getIdPeople()->value();
            $documentModel->description = $document->getDescription()->value();
            $documentModel->state = $document->getState()->value();
            $documentModel->document_number = $document->getNumberDocument()->value();

            $documentModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(DocumentId $id): ?Document
    {
        try {

            $documentModel = DocumentModel::where("id", $id->value())->first();

            if (!$documentModel) {
                throw new InfrastructureException("Identificador del documento no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $this->mapToDomain($documentModel);
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(int $page = 1, int $per_page = 10): array
    {
        try {
            $documentsModels = DocumentModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $documentsModels->items());

            $this->documentsArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $documentsModels->currentPage(),
                    'last_page' => $documentsModels->lastPage(),
                    'per_page' => $documentsModels->perPage(),
                    'total' => $documentsModels->total(),
                ]
            ];

            return $this->documentsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(DocumentId $id): void
    {
        try {
            $documentModel = DocumentModel::find($id->value());

            $documentModel->state = false;
            $documentModel->save();
            $documentModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(DocumentModel $document): Document
    {

        return new Document(
            new DocumentNumberDoc($document->document_number),
            new DocumentDescription($document->description),
            new DocumentIdPeople($document->id_people),
            new DocumentIdTypeDocument($document->id_type_document),
            new DocumentState($document->state),
            new DocumentId($document->id),
        );
    }
}
