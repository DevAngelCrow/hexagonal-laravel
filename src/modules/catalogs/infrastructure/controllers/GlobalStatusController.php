<?php
namespace Src\modules\catalogs\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\application\dtos\GlobalStatusDto;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusCreate;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusDelete;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusGetAll;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusGetOneById;
use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusUpdate;
use Src\modules\catalogs\infrastructure\dtos\globalStatus\GlobalStatusDtoHttp;
use Src\modules\catalogs\infrastructure\validators\globalStatus\CreateGlobalStatusRequest;
use Src\modules\catalogs\infrastructure\validators\globalStatus\DeleteGlobalStatusRequest;
use Src\modules\catalogs\infrastructure\validators\globalStatus\GetAllGlobalStatusRequest;
use Src\modules\catalogs\infrastructure\validators\globalStatus\GetByIdGlobalStatusRequest;
use Src\modules\catalogs\infrastructure\validators\globalStatus\UpdateGlobalStatusRequest;
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
                active: $request->active,
            );

            $this->globalStatusCreate->run($globalDto);
            return $this->created([], "Global Status creado satisfactoriamente");

    }

    public function updateGlobalStatus(UpdateGlobalStatusRequest $request){

            $globalDto = new GlobalStatusDto(
                name: $request->name,
                description: $request->description,
                table_header: $request->table_header,
                active: $request->active,
                id: (int) $request->id,
            );
            $this->globalStatusUpdate->run($globalDto);

            return $this->success([], "Global Status actualizado con éxito");
    }
    public function getAllGlobalStatus(GetAllGlobalStatusRequest $request){


        $globalStatusCollection = $this->globalStatusGetAll->run($request->query('page'), $request->query('per_page'));

        $collections = array_map(fn($item) => GlobalStatusDtoHttp::fromEntity($item), $globalStatusCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $globalStatusCollection['pagination']);

        return $this->success($paginateData, "Success");
    }

    public function getOneByIdGlobalStatus(GetByIdGlobalStatusRequest $request){


        $document = $this->globalStatusGetOneById->run($request->id);


        return $this->success(GlobalStatusDtoHttp::fromEntity($document), "Success");
    }
    public function deleteGlobalStatus(DeleteGlobalStatusRequest $request)
    {
        $this->globalStatusDelete->run($request->id);

        return $this->success([], "Registro de global status borrado exitosamente");
    }
}
