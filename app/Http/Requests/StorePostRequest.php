<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->method == 'post') {
            return [
                'title' => "required",
                'category_id' => "required",
                'sub_category_id' => "required",
                'type' => "required",
                'featured_img' => "required|image|max:2048",
                'content' => "required",
            ];
        } else {
            return [
                'title' => "bail",
                'category_id' => "bail",
                'sub_category_id' => "bail",
                'type' => "bail",
                'featured_img' => "bail|image|max:2048",
                'content' => "bail",
            ];
        }
    }
}
