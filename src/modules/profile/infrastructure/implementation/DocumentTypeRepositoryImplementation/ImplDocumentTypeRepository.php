<?php

namespace Src\modules\profile\infrastructure\implementation\DocumentTypeRepositoryImplementation;

use LogicException;
use Src\modules\profile\domain\entities\documentType\DocumentType;
use Src\modules\profile\domain\repositories\documentType\DocumentTypeRepositoryInterface;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeId;
use App\Models\CtlDocumentType as DocumentTypeModel;
use ErrorException;
use Exception;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeName;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeDescription;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeActive;
use Src\modules\profile\domain\value_objects\documentType_value_object\DocumentTypeMask;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;


class ImplDocumentTypeRepository implements DocumentTypeRepositoryInterface
{
    private array $documentTypeArray = [];
    public function create(DocumentType $documentType): void
    {
        try {
            $documentTypeModel = new DocumentTypeModel;

            $documentTypeModel->name = $documentType->getName()->value();
            $documentTypeModel->description = $documentType->getDescription()->value();
            $documentTypeModel->active = $documentType->getActive()->value();
            $documentTypeModel->mask = $documentType->getMask()->value();
            $documentTypeModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(DocumentType $documentType): void
    {
        try {

            $documentTypeModel = DocumentTypeModel::find($documentType->getId()->value());

            $documentTypeModel->name = $documentType->getName()->value();
            $documentTypeModel->description = $documentType->getDescription()->value();
            $documentTypeModel->active = $documentType->getActive()->value();
            $documentTypeModel->mask = $documentType->getMask()->value();
            $documentTypeModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page, ?int $per_page): array
    {
        try {

            $query = DocumentTypeModel::select('id', 'name', 'description', 'active', 'mask')->orderBy('id');

            if ($page !== null && $per_page !== null) {

                $documentTypeModels = $query->paginate($per_page);

                $data = array_map(fn($item) => $this->mapToDomain($item), $documentTypeModels->items());

                $this->documentTypeArray = [
                    "data" => $data,
                    "pagination" => [
                        'current_page' => $documentTypeModels->currentPage(),
                        'last_page' => $documentTypeModels->lastPage(),
                        'per_page' => $documentTypeModels->perPage(),
                        'total' => $documentTypeModels->total(),
                    ]
                ];

                return $this->documentTypeArray;
            }

            $documentTypeModels = $query->get();
            $this->documentTypeArray = array_map(fn($item) => $this->mapToDomain($item), $documentTypeModels->all());

            return $this->documentTypeArray;
        } catch (Exception $e) {

            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(DocumentTypeId $id): ?DocumentType
    {
        try {

            $documentTypeDb = DocumentTypeModel::where("id", $id->value())->first();

            if (!$documentTypeDb) {
                throw new InfrastructureException("identificador de documentType no encontrada", Response::HTTP_NOT_FOUND);
            }

            $document = $this->mapToDomain($documentTypeDb);

            return $document;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(DocumentTypeId $id): void
    {
        try {
            $documentTypeDb = DocumentTypeModel::find($id->value());

            $documentTypeDb->current = false;
            $documentTypeDb->save();
            $documentTypeDb->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(DocumentTypeModel $document): DocumentType
    {
        return new DocumentType(
            new DocumentTypeName($document->name),
            new DocumentTypeDescription($document->description),
            new DocumentTypeActive($document->active),
            new DocumentTypeMask($document->mask),
            new DocumentTypeId($document->id),
        );
    }
}
