<?php

namespace Src\modules\catalogs\marital\infrastructure\api\validators\v1;

use Src\modules\catalogs\marital\application\CreateMaritalUseCase\CreateMaritalDto;
use Src\shared\infrastructure\validators\BaseRequest;

class CreateMaritalStatusRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'min:2', 'max:100'],
            "description" => ['required', 'string', 'min:4', 'max:100']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = (object) parent::validated($key, $default);

        return new CreateMaritalDto(
            name: $data->name,
            description: $data->description,
        );
    }
}
