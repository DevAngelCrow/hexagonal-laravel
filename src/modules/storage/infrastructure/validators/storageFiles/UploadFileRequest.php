<?php
namespace Src\modules\storage\infrastructure\validators\storageFiles;

use Src\shared\infrastructure\validators\BaseRequest;

class UploadFileRequest extends BaseRequest {
    public function rules() : array{
        return [
            "content_files" => "file|mimes:jpg,jpeg,png|max:2048"
        ];
    }
}