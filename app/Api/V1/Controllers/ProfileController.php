<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;

class ProfileController extends Controller
{
    use Helpers;

    public function myUserInfo()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        if (!$currentUser)
            throw new NotFoundHttpException;

        return $this->response->array($currentUser);
    }

    public function update(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        if (!$currentUser)
            throw new NotFoundHttpException;

        $currentUser->fill($request->all());

        if ($currentUser->save())
            return $this->response->array($currentUser);
        else
            return $this->response->error('could_not_update_post', 500);
    }
}