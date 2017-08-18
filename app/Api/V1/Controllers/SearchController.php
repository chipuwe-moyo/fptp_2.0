<?php

namespace App\Api\V1\Controllers;

use App\Commodity;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if ($request->has('q')) {
            $commodities = Commodity::search($request->get('q'))->get();
            $users = User::search($request->get('q'))->get();

            return
                [
                    $commodities->count() ? $commodities : $error,
                    $users->count() ? $users : $error
                ];
        }

        return $error;
    }
}
