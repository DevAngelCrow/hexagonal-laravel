<?php
namespace Src\modules\profile\infrastructure\validators;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest{
    public function authorize() : bool {
        return true;
    }

    public function wantsJson(): bool
    {
        return true;
    }

    public function rules() : array {
        return [];
    }
    
}