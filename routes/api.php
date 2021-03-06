<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('register', 'App\\Api\\V1\\Controllers\\Auth\\UserController@register');
        $api->post('login', 'App\\Api\\V1\\Controllers\\Auth\\UserController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\Auth\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\Auth\\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => 'api.auth'], function (Router $api) {
        $api->get('/commodity/mine', 'App\\Api\\V1\\Controllers\\CommodityController@index');
        $api->post('/commodity/store', 'App\\Api\\V1\\Controllers\\CommodityController@store');
        $api->put('/commodity/{id}', 'App\\Api\\V1\\Controllers\\CommodityController@update');
        $api->delete('/commodity/{id}', 'App\\Api\\V1\\Controllers\\CommodityController@destroy');

        $api->post('/commodity/notify/{id}', 'App\\Api\\V1\\Controllers\\CommodityController@notify');
        $api->get('/commodity/notifications', 'App\\Api\\V1\\Controllers\\CommodityController@notifications');

        $api->get('/user/info', 'App\\Api\\V1\\Controllers\\ProfileController@myUserInfo');
        $api->get('/user/all', 'App\\Api\\V1\\Controllers\\ProfileController@viewAll');
        $api->get('/user/{id}', 'App\\Api\\V1\\Controllers\\ProfileController@userInfo');
        $api->put('/user/update', 'App\\Api\\V1\\Controllers\\ProfileController@update');
    });


    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'Farmer Produce Trading Platform: This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });

    $api->get('/commodity/all', 'App\\Api\\V1\\Controllers\\CommodityController@viewAll');
    $api->get('/commodity/info/{id}', 'App\\Api\\V1\\Controllers\\CommodityController@commodityInfo');

    $api->get('/search', 'App\\Api\\V1\\Controllers\\SearchController@search');

    $api->post('/product', 'App\\Api\\V1\\Controllers\\ProductController@store');
    $api->get('/product/all', 'App\\Api\\V1\\Controllers\\ProductController@allProducts');
});
