<?php

namespace App\Api\V1\Controllers;

use App\Notifications\Interest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;
use App\Commodity;
use Dingo\Api\Routing\Helpers;


class CommodityController extends Controller
{
    use Helpers;

    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $commodities = $currentUser
            ->commodities()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        return $this->response->array(['commodities' => $commodities]);
    }

    public function viewAll()
    {
        $commodities = Commodity::all();

        return $this->response->array(['commodities' => $commodities]);
    }

    public function commodityInfo($id)
    {
        $commodity = Commodity::find($id);

        return $this->response->array(['commodity' => $commodity]);
    }

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $commodity = new Commodity;

        $commodity->product = $request->get('product');
        $commodity->description = $request->get('description', false);
        $commodity->price = $request->get('price');
        $commodity->quantity = $request->get('quantity');
        $commodity->metric = $request->get('metric');
        $commodity->town = $request->get('town');
        $commodity->province = $request->get('province');
        $commodity->country = $request->get('country');
        if ($request->hasFile('photo')) {
            $commodity->photo = $request->file('photo')->store('img/commodities');
        }

        if($currentUser->commodities()->save($commodity))
            return $this->response->array(['commodity' => $commodity]);
        else
            return $this->response->error('could_not_post_commodity', 500);
    }

    public function update(Request $request, $id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $commodity = $currentUser->commodities()->find($id);
        if(!$commodity)
            throw new NotFoundHttpException;

        $commodity->fill($request->all());

        if($commodity->save())
            return $this->response->array(['commodity' => $commodity]);
        else
            return $this->response->error('could_not_update_post', 500);
    }

    public function destroy($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $commodity = $currentUser->commodities()->find($id);

        if(!$commodity)
            throw new NotFoundHttpException;

        if($commodity->delete())
            return $this->response->array(['message' => 'Commodity Deleted']);
        else
            return $this->response->error('could_not_delete_post', 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return
     * @internal param $commodity
     */
    public function notify(Request $request, $id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $commodity = Commodity::findOrFail($id);
        $recipient = User::findOrFail($commodity->user_id);
        $message = $request->get('message');

        $recipient->notify(new Interest($commodity, $currentUser, $message));

        return $this->response->array([
            'message' => $message,
            'from' => $currentUser,
            'to' => $recipient,
            'on' => $commodity
        ]);
    }

    public function notifications()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $notifications = $currentUser->notifications;

        return $this->response->array(['notifications' => $notifications]);
    }
}
