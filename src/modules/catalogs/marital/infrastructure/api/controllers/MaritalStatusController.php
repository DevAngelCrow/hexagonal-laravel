<?php

namespace Src\modules\catalogs\marital\infrastructure\api\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\marital\application\CreateMaritalUseCase\CreateMaritalUseCase;
use Src\modules\catalogs\marital\application\ListMaritalUseCase\ListMaritalUseCase;
use Src\modules\catalogs\marital\infrastructure\api\validators\v1\CreateMaritalStatusRequest;
use Src\shared\infrastructure\HttpResponses;

class MaritalStatusController extends Controller
{
    use HttpResponses;

    public function __construct(
        private readonly CreateMaritalUseCase $createMaritalUseCase,
        private readonly ListMaritalUseCase $listMaritalUseCase
    ) {}

    public function index()
    {

        $maritalStatusList = collect($this->listMaritalUseCase->run())->map->toArray();

        return $this->success($maritalStatusList, 'Lista de estados civiles obtenida con éxito');
    }


    public function store(CreateMaritalStatusRequest $request)
    {

        $marital = $this->createMaritalUseCase->run($request->validated());

        return $this->created($marital->toArray(), 'Estado civil creado con éxito');
    }
}
