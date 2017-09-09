<?php

namespace App\Api\V1\Controllers;

use App\Product;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use Helpers;
    public function store(Request $request){
        $product = new Product;

        $product->name = $request->get('name');
        $product->type = $request->get('type');

        if($product->save())
            return $this->response->array(['product' => $product]);
        else
            return $this->response->error('could_not_store_product', 500);
    }

    public function allProducts(){
        $products = Product::all();

        return $this->response->array(['products' => $products]);
    }
}
