<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addTaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'task' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'User name is required',
            'task.required'  => 'A task is required',
        ];
    }
}
