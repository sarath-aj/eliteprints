<?php

namespace App\Http\Requests\Order;

use App\Rules\ValidShippingMethodRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
        return [
            'shipping_method_id' => [
                'required', 'exists:shipping_methods,id', new ValidShippingMethodRule($this->get('address_id'))
            ],
            'address_id' => [
                'required', Rule::exists('addresses', 'id')->where('user_id', $this->user()->id),
            ],
            'payment_method_id' => [
                'required', Rule::exists('payment_methods', 'id')->where('user_id', $this->user()->id),
            ],
        ];
    }
}
