<?php

declare(strict_types=1);

namespace App\Http\Requests\Memos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DeleteRequest
 * @package App\Http\Requests\Memos
 */
class DeleteRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
