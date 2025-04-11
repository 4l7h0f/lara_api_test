<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search'    => 'nullable|string|max:255',
            'from'      => 'nullable|date',
            'to'        => 'nullable|date|after_or_equal:from',
            'sort_by'   => 'nullable|in:name,email,created_at',
            'sort_dir'  => 'nullable|in:asc,desc',
        ];
    }
}
