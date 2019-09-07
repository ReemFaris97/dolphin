<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
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
            "name" => "required|string|max:191",
            "description" => "required|string",
            "type" => "required|string|in:period,date,after_task,depends",
            "date" => "nullable|date",
            "time_from" => "required_if:type,date|required_if:type,period|nullable",
            "clause_id" => "required_if:type,depends|nullable|integer|exists:clauses,id",
            "equation_mark" => "required_if:type,depends|nullable|in:<,>,=,<=,>=",
            "period" => "required_if:type,period|integer|nullable",
            'after_task_id' => 'required_if:type,after|nullable|integer|exists:tasks,id',
            'clause_amount' => 'required_if:task,depends|nullable'
        ];
    }
}
