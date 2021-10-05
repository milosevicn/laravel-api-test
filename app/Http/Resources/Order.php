<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        $total = 0;
        foreach($this->products as $product_id) {
            $product = Product::find($product_id);
            $total += $product->price;
        }

        return [
            'total' => $total
        ];
    }
}
