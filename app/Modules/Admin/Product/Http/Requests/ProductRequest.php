<?php

namespace App\Modules\Admin\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProductRequest
 *
 * @package App\Modules\Admin\Product\Http\Requests
 */
class ProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'                  => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($this->id),
            ],
            'avatar'                => [
                $this->id ? 'sometimes' : 'required',
                'file',
                'max:'.config('upload.file_max_size'),
                'mimetypes:'.implode(',', config('upload.image_mime_types_allow')),
            ],
            'category_id'           => 'required',
            'description'           => 'required',
            'introduce'             => 'required',
            'brand_id'              => 'required',
            'price'                 => 'required|numeric',
            'sub_image.*'           => [
                'file',
                'max:'.config('upload.file_max_size'),
                'mimetypes:'.implode(',', config('upload.image_mime_types_allow')),
            ],
            'storehouse.*.name'     => 'required|distinct',
            'storehouse.*.quantity' => 'required|numeric|min:1',
        ];
    }

    public function getValidatorInstance()
    {
        $this->formatPrice();

        return parent::getValidatorInstance();
    }

    protected function formatPrice()
    {
        if ($this->request->has('price')) {
            $this->merge(
                [
                    'price' => str_replace(',', '', request('price')),
                ]
            );
        }
    }
}
