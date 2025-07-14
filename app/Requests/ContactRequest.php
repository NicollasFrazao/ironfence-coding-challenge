<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
        $contact_id = $this->route('contact')?->id ?? null;

        return [
            'name' => 'required|min:6',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('contacts')->ignore($contact_id),
            ],
            'phone' => [
                'required',
                'min:9',
                'max:9',
                Rule::unique('contacts')->ignore($contact_id),
            ],
        ];
    }
}
