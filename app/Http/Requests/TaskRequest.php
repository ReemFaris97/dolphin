<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            "period" => "required_if:type,period|integer|nullable|min:0",
            'after_task_id' => 'required_if:type,after|nullable|integer|exists:tasks,id',
            'users'=>'required|array',
            "users.*.user_id" => 'nullable|integer|exists:users,id',
            "users.*.days" => "nullable|integer|min:0|max:265",
            "users.*.hours" => "nullable|integer|min:0|max:24",
            "users.*.minutes" => "nullable|integer|min:0|max:60",
            "users.*.rater_id" => "nullable|integer|exists:users,id",
            "users.*.finisher_id" =>"nullable|integer|exists:users,id",
            'clause_amount' => 'required_if:task,depends|nullable|min:0'
        ];
    }
}
