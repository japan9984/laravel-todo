<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required' ,
            'deadline' => 'required'
        ];
    }

    // 記述方法：['検証する値'=>'検証ルール1 | 検証ルール2',]
    // もしくは、['検証する値'=>['検証ルール1', '検証ルール2'],]
}
