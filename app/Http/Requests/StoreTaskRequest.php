<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required',
            'cover' => 'required',
            'description' => 'required',
            'position' => 'required',
            'board_id' => 'required|exists:boards,id',
            'task_list_id' => 'required|exists:task_lists,id',
        ];
    }
}
