<?php

namespace Modules\Account\app\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Modules\Account\app\Rules\NationalIdRule;

class RegisterRequest extends BaseRequest
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
            'username' => ['required', 'unique:users', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'national_id' => ['string', 'unique:users', new NationalIdRule()],
            'email' => ['required', 'unique:users', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

}
