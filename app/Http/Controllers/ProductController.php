<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\Product as ResourcesProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->all());
        $product->user_id = Auth::user()->id;
        
        if($product->save()) {
            return new ResourcesProduct($product);
        }
    }

    public function delete(StoreProductRequest $request)
    {
        $product = new Product($request->all());
        $product->user_id = Auth::user()->id;
        
        if($product->save()) {
            return new ResourcesProduct($product);
        }
    }

}
