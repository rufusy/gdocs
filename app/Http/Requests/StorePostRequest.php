<?php

namespace App\Http\Requests;

use App\Rules\IntegerArray;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'body' => ['array', 'required'],
            'user_ids' => [
                'array',
                'required',
                new IntegerArray()
//                function($attribute, $value, $fail) {
//                    $integerOnly = collect($value)->every(fn ($element) => is_int($element));
//                    if(!$integerOnly) {
//                        $fail($attribute . ' can only be integers.');
//                    }
//                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'body.required' => 'Body is required.'
        ];
    }
}
