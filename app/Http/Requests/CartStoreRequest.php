<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $existing_cart = Cart::where('product_id', $this->product->id)
            ->where('user_id', $this->user()->id)
            ->first();

        if ($existing_cart == null) {
            return [
                'amount' => ['required', 'gte:1', 'lte:' . $this->product->stock],
            ];
        } else {
            return [
                'amount' => ['required', 'gte:1', 'lte:' . ($this->product->stock - $existing_cart->amount)],
            ];
        }
    }
}
