<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Task;

class TaskRequest extends FormRequest
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
            'description' => [
                'required',
            ],
            'due_date' => [
                'required',
                'date:y-m-d H:i',
            ],
            'status' => [
                'nullable',
                Rule::in(collect(Task::$select_status)->keys()->all()),
            ],
            'priority' => [
                'required',
                Rule::in(collect(Task::$select_priority)->keys()->all()),
            ],
        ];
    }
}
