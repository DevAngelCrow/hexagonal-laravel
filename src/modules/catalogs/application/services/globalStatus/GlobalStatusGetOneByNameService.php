<?php
namespace Src\modules\catalogs\application\services\globalStatus;

use Src\modules\catalogs\application\usesCases\globalStatus\GlobalStatusGetOneByName;

class GlobalStatusGetOneByNameService {
    private readonly GlobalStatusGetOneByName $globalStatusGetOneByName;

    public function __construct(GlobalStatusGetOneByName $globalStatus_get_one_by_name)
    {
        $this->globalStatusGetOneByName = $globalStatus_get_one_by_name;
    }

    public function globalStatusGetOneByNameService(string $name, string $table_header){
        $globalStatus = $this->globalStatusGetOneByName->run($name, $table_header);
        
        return $globalStatus;
    }
}