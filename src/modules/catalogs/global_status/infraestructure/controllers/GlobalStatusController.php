<?php

namespace Src\modules\catalogs\global_status\infraestructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\global_status\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusGetAll;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusCreate;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusUpdate;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusDelete;
use Src\modules\catalogs\global_status\application\useCases\GlobalStatusGetOneById;

use Src\modules\catalogs\global_status\infraestructure\dtos\GlobalStatusDtoHttp;
use Src\modules\catalogs\global_status\infraestructure\validators\CreateGlobalStatusRequest;
use Src\modules\catalogs\global_status\infraestructure\validators\GetAllGlobalStatusRequest;
use Src\modules\catalogs\global_status\infraestructure\validators\GetByIdGlobalStatusRequest;
use Src\modules\catalogs\global_status\infraestructure\validators\UpdateGlobalStatusRequest;
use Src\modules\catalogs\global_status\infraestructure\validators\DeleteGlobalStatusRequest;


use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class GlobalStatusController extends Controller
{
    use HttpResponses;
    protected GlobalStatusCreate $globalStatusCreate;
    protected GlobalStatusGetAll $globalStatusGetAll;
    protected GlobalStatusGetOneById $globalStatusGetOneById;
    protected GlobalStatusUpdate $globalStatusUpdate;

    protected GlobalStatusDelete $globalStatusDelete;

    public function __construct(GlobalStatusCreate $globalStatus_create, GlobalStatusGetAll $globalStatus_get_all,
    GlobalStatusGetOneById $globalStatus_get_one_by_id, GlobalStatusUpdate $globalStatus_update)
    {
        $this->globalStatusCreate = $globalStatus_create;
        $this->globalStatusGetAll = $globalStatus_get_all;
        $this->globalStatusGetOneById = $globalStatus_get_one_by_id;
        $this->globalStatusUpdate = $globalStatus_update;
    }

    public function createGlobalStatus(CreateGlobalStatusRequest $request)
    {
            $globalDto = new GlobalStatusDto(
                name: $request->name,
                description: $request->description,
                table_header: $request->table_header,
            );

            $this->globalStatusCreate->run($globalDto);
            return $this->created([], "Global Status creado satisfactoriamente");

    }

    public function updateGlobalStatus(UpdateGlobalStatusRequest $request){

            $globalDto = new GlobalStatusDto(
                name: $request->name,
                description: $request->description,
                table_header: $request->table_header,
                id: (int) $request->id,
            );
            $this->globalStatusUpdate->run($globalDto);

            return $this->success([], "Global Status actualizado con éxito");
    }
    public function getAllDocumentType(GetAllGlobalStatusRequest $request){


        $globalStatusCollection = $this->globalStatusGetAll->run($request->query('page'), $request->query('per_page'));

        $collections = array_map(fn($item) => GlobalStatusDtoHttp::fromEntity($item), $globalStatusCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $globalStatusCollection['pagination']);

        return $this->success($paginateData, "Success");
    }

    public function getOneByIdDocumentType(GetByIdDocumentTypeRequest $request){


        $document = $this->globalStatusGetOneById->run($request->id);


        return $this->success(DocumentTypeDtoHttp::fromEntity($document), "Success");
    }
    public function deleteDocumentType(DeleteDocumentTypeRequest $request)
    {
        $this->globalStatusDelete->run($request->id);

        return $this->success([], "Registro de tipo de documento borrado exitosamente");
    }
}
