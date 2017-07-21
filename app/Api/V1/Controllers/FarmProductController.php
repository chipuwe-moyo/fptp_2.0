<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\FarmProduct;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;


class FarmProductController extends Controller
{
    use Helpers;

    public function index()
    {
        $farmProducts = FarmProduct::all();

        return $this->response->array(['products' => $farmProducts]);
    }

    public function store(Request $request)
    {
        $farmProduct = new FarmProduct;

        $farmProduct->name = $request->get('name');
        $farmProduct->product_type = $request->get('product_type');

        if ($farmProduct->save())
            return $this->response->array(['product' => $farmProduct]);
        else
            return $this->response->error('could_not_post_product', 500);
    }

    public function update(Request $request, $id)
    {
        $farmProduct = FarmProduct::all()->find($id);
        if (!$farmProduct)
            throw new NotFoundHttpException;

        $farmProduct->fill($request->all());

        if ($farmProduct->save())
            return $this->response->array(['product' => $farmProduct]);
        else
            return $this->response->error('could_not_update_product', 500);
    }

    public function delete($id)
    {
        $farmProduct = FarmProduct::all()->find($id);
        if (!$farmProduct)
            throw new NotFoundHttpException;

        if ($farmProduct->delete())
            return $this->response->array(['message' => 'Farm Product Deleted']);
        else
            return $this->response->error('could_not_delete_product', 500);
    }
}
