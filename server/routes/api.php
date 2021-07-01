<?php

// Admin Routes
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:api', 'admin']
], function () {
    Route::resource('settings', 'Api\Settings\SettingsController');
    Route::get('brands', 'Api\Brand\BrandsController@index');
    Route::get('reports', 'Api\Reports\ReportsController@reports');
    Route::resource('products', 'Api\Products\ProductController');
    // Route::delete('products/variation/{id}', 'Api\Products\ProductController@deleteVariation');
    Route::delete('products/{id}/{key}', 'Api\Products\ProductController@deleteImageFromImageGallery');
    Route::post('products/main-image-upload/{id}/', 'Api\Products\ProductController@updateMainImage');
    Route::post('products/image-gallery-upload/{id}/', 'Api\Products\ProductController@addToImageGallery');

    Route::post('product-variation/{productId}/', 'Api\Products\ProductController@addVariation');
    Route::delete('product-variation/{id}/{productId}', 'Api\Products\ProductController@deleteVariation');
    Route::put('product-variation/{id}/{productId}', 'Api\Products\ProductController@updateVariation');
});

// products sitemap
Route::get('products-sitemap', 'Api\Products\ProductController@productsSitemap');

// Front-End Routes
Route::get('search', 'Api\search\SearchController@search');
Route::post('contact-us', 'Api\Contact\ContactController@saveContact');
Route::resource('countries', 'Api\Countries\CountryController');
Route::resource('featured', 'Api\Featured\FeaturedController');
Route::resource('products', 'Api\Products\ProductController');
Route::get('filter-products/{gender}', 'Api\Products\ProductController@filterProducts');
Route::get('filter-all-products', 'Api\Products\ProductController@allProductsFilter');
Route::resource('settings', 'Api\Settings\SettingsController');
Route::get('brands', 'Api\Brand\BrandsController@index');
Route::get('colors', 'Api\Color\ColorsController@index');

// Customer Auth Routes
Route::post('login', 'Api\Auth\AuthController@login');
Route::post('register', 'Api\Auth\AuthController@register');
Route::post('logout', 'Api\Auth\AuthController@logout');
Route::get('user', 'Api\Auth\AuthController@user');

// Admin Auth Routes
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Api\Auth',
], function () {
    Route::post('login', 'AuthController@adminLogin');
    Route::post('register', 'AuthController@adminRegister')->middleware(['auth:api', 'admin']);
    Route::post('logout', 'AuthController@logout')->middleware(['auth:api', 'admin']);
    Route::get('user', 'AuthController@user')->middleware(['auth:api', 'admin']);
});


// Cart Routes
Route::group([
    'prefix' => 'cart',
    'namespace' => 'Api\Cart',
], function () {
    Route::get('/', 'CartController@index');
    Route::post('/', 'CartController@store');
    Route::put('{productVariation}', 'CartController@update');
    Route::delete('{productVariation}', 'CartController@destroy');
});

// Shipping Route
Route::group([
    'prefix' => 'addresses',
], function () {
    Route::get('{address}/shipping', 'Api\Addresses\AddressShippingController@index');
});

// Checkout Routes

Route::resource('addresses', 'Api\Addresses\AddressesController');
// Route::resource('shipping-method', 'Api\ShippingMethod\ShippingMethodController');
Route::resource('orders', 'Api\Orders\OrdersController');
Route::resource('payment-methods', 'Api\PaymentMethods\PaymentMethodController');


// Admin Routes
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:api', 'admin']
], function () {
    Route::resource('settings', 'Api\Settings\SettingsController');
    Route::get('reports', 'Api\Reports\ReportsController@reports');
    Route::resource('datatable/customers', 'Api\DataTable\UserController');
    Route::resource('datatable/brands', 'Api\DataTable\BrandController');
    Route::resource('datatable/orders', 'Api\DataTable\OrderController');
    Route::get('order/{orderID}', 'Api\Orders\OrdersController@show');
    Route::resource('products', 'Api\Products\ProductController');
    Route::resource('datatable/products', 'Api\DataTable\ProductController');
    Route::resource('datatable/admin-user', 'Api\DataTable\AdminUserController');
});


// Customer Account Rotues
Route::group([
    'prefix' => 'customer',
], function () {
    Route::post('change-password', 'Api\Customer\CustomerController@changePassword');
    Route::post('edit-account', 'Api\Customer\CustomerController@editAccount');
    Route::resource('addresses', 'Api\Addresses\AddressesController');
    Route::resource('orders', 'Api\Orders\OrdersController');
});

Route::post('track-order', 'Api\OrderTracking\OrderTrackingController@trackOrder');