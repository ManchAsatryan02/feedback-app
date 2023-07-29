<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $requets)
    {
        if($requets->type == 0){
            return [
                'name' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'type' => ['required', 'integer'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->symbols()
                        ->numbers()
                ]
            ];
        }else{
            return [
                'name' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'type' => ['required', 'integer'],
                'email' => ['required', 'email', 'unique:users,email'],
                'address' => ['required', 'string'],
                'hvhh' => ['required', 'string', 'unique:users,hvhh'],
                'logo' => ['required', 'string'],
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->symbols()
                        ->numbers()
                ]
            ];
        }
        
    }
}