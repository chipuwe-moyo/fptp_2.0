<?php

namespace App\Api\V1\Controllers;

use App\Commodity;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    use Helpers;
    public function search(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if ($request->has('q')) {
            $commodities = Commodity::search($request->get('q'))->get();

            return $this->response->array(['commodities' => $commodities->count() ? $commodities : $error]);
        }

        return $this->response->array(['error' => $error]);
    }
}
