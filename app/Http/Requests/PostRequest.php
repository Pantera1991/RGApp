<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $titleRule = Rule::unique('posts', 'title');

        if ($this->post) {
            $titleRule->ignore($this->post->id);
        }

        return [
            'title' => 'required|min:3|max:60|' . $titleRule,
            'author' => 'required|min:3|max:100',
            'content' => 'required'
        ];
    }
}
