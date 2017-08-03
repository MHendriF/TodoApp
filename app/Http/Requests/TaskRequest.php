<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() ? true : false;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'desc' => 'required|min:10|max:150',
            'duedate' => 'required'
        ];
    }
}
