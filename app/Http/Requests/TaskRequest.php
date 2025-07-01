<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = $this->route('task');

        if ($task) {
            return $task->owner->id === auth()->id();
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'due_date' => 'nullable|date',
        ];

        // Si es update (tienes el status)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|in:pending,completed';
        }

        return $rules;
    }
}
