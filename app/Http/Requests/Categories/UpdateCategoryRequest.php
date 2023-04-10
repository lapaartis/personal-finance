<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $userId = $this->user()->id;
        $categoryId = $this->route('category')->id;

        return [
            'name' => [
                'required',
                Rule::unique('categories')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })->ignore($categoryId),
            ],
        ];
    }
}
