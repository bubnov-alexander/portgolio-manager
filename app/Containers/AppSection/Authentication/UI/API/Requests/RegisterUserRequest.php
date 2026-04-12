<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rules\Password;

final class RegisterUserRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::default(),
            ],
            'name' => 'min:2|max:50',
        ];
    }
}
