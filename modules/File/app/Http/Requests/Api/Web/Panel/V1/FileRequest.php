<?php

namespace Modules\File\app\Http\Requests\Api\Web\Panel\V1;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FileRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'file' => ['required', 'file', 'mimetypes:image/jpeg,image/png', 'max:1024'],
        ];
    }

}
