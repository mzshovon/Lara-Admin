<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'FrontEnd\HomeController@index')->name('home');
Route::get('/product/{id}', 'FrontEnd\HomeController@productDetails');
Route::post('/search_product', 'FrontEnd\HomeController@searchProducts')->name('search_products');
Route::post('/cart-add', 'FrontEnd\CartController@addCart');
Route::get('/cart-list', 'FrontEnd\CartController@index');
Route::post('/cart-delete', 'FrontEnd\CartController@delete');
Route::post('/cart-update', 'FrontEnd\CartController@update');
Route::post('/cart-discount', 'FrontEnd\CartController@setDiscount');
Route::post('/reviews', 'FrontEnd\HomeController@c')->name('review');
Route::get('/category-products/{id}', 'FrontEnd\HomeController@categoryProduct');
Route::get('/show-more-products', 'FrontEnd\HomeController@featuredProducts')->name('featured_products');
Route::get('/show-more-categories', 'FrontEnd\HomeController@featured_categories')->name('featured_categories');
Route::get('/new-items', 'FrontEnd\HomeController@newItem');
Route::get('/get-coupons', 'FrontEnd\HomeController@getCoupon');
Route::get('/monthly-ad', 'FrontEnd\HomeController@monthlyAd');

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END


Auth::routes();
Route::group(['middleware'=> ['auth']], function (){
    Route::get('/checkout', 'FrontEnd\CheckoutController@index');
    Route::post('/checkout-update', 'FrontEnd\CheckoutController@update');
    Route::post('/order-place', 'FrontEnd\CheckoutController@orderPlace');
    Route::get('/payment', 'FrontEnd\CartController@paymentForm');
    Route::post('/pay', 'FrontEnd\PaymentController@redirectToGateway')->name('pay');
    Route::get('/payment-details', 'FrontEnd\PaymentController@handleGatewayCallback');
    Route::get('/track_order', 'FrontEnd\CheckoutController@trackIndex')->name('track_order');
    Route::get('/order_details_from_user/{id}', 'FrontEnd\CheckoutController@checkDetails')->name('order_details');
//    Route::get('/cash_on_delivery', 'FrontEnd\PaymentController@handleGatewayCallback');
});
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return redirect('/admin/login');
});
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::group(['prefix'=>'admin', 'middleware'=> ['AdminAuth']], function (){

    Route::get('/dashboard', 'Admin\HomeController@index')->name('admin.dashboard');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    /*Users Route*/
    Route::get('/users', 'Admin\UserController@index');
    Route::get('/users/details/{id}', 'Admin\UserController@details');
    Route::get('/users/edit/{id}', 'Admin\UserController@edit');
    Route::post('/users/edit', 'Admin\UserController@update');
    Route::post('/users/delete', 'Admin\UserController@delete');
    Route::post('/users/change-status', 'Admin\UserController@changeStatus');

    /*Departments Route*/
    Route::get('/departments', 'Admin\DepartmentController@index');
    Route::get('/departments/add', 'Admin\DepartmentController@add');
    Route::post('/departments/add', 'Admin\DepartmentController@store');
    Route::get('/departments/details/{id}', 'Admin\DepartmentController@details');
    Route::get('/departments/edit/{id}', 'Admin\DepartmentController@edit');
    Route::post('/departments/edit', 'Admin\DepartmentController@update');
    Route::post('/departments/delete', 'Admin\DepartmentController@delete');
    Route::post('/departments/change-status', 'Admin\DepartmentController@changeStatus');

    /*Categories Route*/
    Route::get('/categories', 'Admin\CategoryController@index');
    Route::get('/categories/add', 'Admin\CategoryController@add');
    Route::post('/categories/add', 'Admin\CategoryController@store');
    Route::get('/categories/details/{id}', 'Admin\CategoryController@details');
    Route::get('/categories/edit/{id}', 'Admin\CategoryController@edit');
    Route::post('/categories/edit', 'Admin\CategoryController@update');
    Route::post('/categories/delete', 'Admin\CategoryController@delete');
    Route::post('/categories/change-status', 'Admin\CategoryController@changeStatus');

    /*Brands Route*/
    Route::get('/brands', 'Admin\BrandController@index');
    Route::get('/brands/add', 'Admin\BrandController@add');
    Route::post('/brands/add', 'Admin\BrandController@store');
    Route::get('/brands/details/{id}', 'Admin\BrandController@details');
    Route::get('/brands/edit/{id}', 'Admin\BrandController@edit');
    Route::post('/brands/edit', 'Admin\BrandController@update');
    Route::post('/brands/delete', 'Admin\BrandController@delete');
    Route::post('/brands/change-status', 'Admin\BrandController@changeStatus');

    /*Products Route*/
    Route::get('/products', 'Admin\ProductController@index');
    Route::get('/products/add', 'Admin\ProductController@add');
    Route::post('/products/add', 'Admin\ProductController@store');
    Route::get('/products/details/{id}', 'Admin\ProductController@details');
    Route::get('/products/edit/{id}', 'Admin\ProductController@edit');
    Route::post('/products/edit', 'Admin\ProductController@update');
    Route::post('/products/delete', 'Admin\ProductController@delete');
    Route::post('/products/change-status', 'Admin\ProductController@changeStatus');

    /*Shipping Route*/
    Route::get('/shipping', 'Admin\ShippingController@index');
    Route::get('/shipping/add', 'Admin\ShippingController@add');
    Route::post('/shipping/add', 'Admin\ShippingController@store');
    Route::get('/shipping/edit/{id}', 'Admin\ShippingController@edit');
    Route::post('/shipping/edit', 'Admin\ShippingController@update');
    Route::post('/shipping/delete', 'Admin\ShippingController@delete');

    /*Regions Route*/
    Route::get('/regions', 'Admin\RegionController@index');
    Route::get('/regions/add', 'Admin\RegionController@add');
    Route::post('/regions/add', 'Admin\RegionController@store');
    Route::get('/regions/edit/{id}', 'Admin\RegionController@edit');
    Route::post('/regions/edit', 'Admin\RegionController@update');
    Route::post('/regions/delete', 'Admin\RegionController@delete');

    /*Orders Route*/
    Route::get('/orders', 'Admin\OrderController@index');
    Route::get('/orders/details/{id}', 'Admin\OrderController@details');
    Route::get('/orders/edit/{id}', 'Admin\OrderController@edit');
    Route::post('/orders/edit', 'Admin\OrderController@update');
    Route::post('/orders/delete', 'Admin\OrderController@delete');
    Route::post('/orders/pending-status', 'Admin\OrderController@pendingStatus');
    Route::post('/orders/complete-status', 'Admin\OrderController@completeStatus');
    Route::post('/orders/cancel-status', 'Admin\OrderController@cancelStatus');

    /*Utilities*/
    Route::get('/monthly-ads', 'Admin\UtilityController@monthlyAdIndex');
    Route::get('/monthly-ads/add', 'Admin\UtilityController@monthlyAdAdd');
    Route::post('/monthly-ads/add', 'Admin\UtilityController@monthlyAdStore');
    Route::get('/monthly-ads/edit/{id}', 'Admin\UtilityController@monthlyAdEdit');
    Route::post('/monthly-ads/edit', 'Admin\UtilityController@monthlyAdUpdate');
    Route::post('/monthly-ads/delete', 'Admin\UtilityController@monthlyAdDelete');

    /*Banners*/
    Route::get('/banner', 'Admin\BannerController@BannerIndex');
    Route::get('/banner/add', 'Admin\BannerController@BannerAdd');
    Route::post('/banner/add', 'Admin\BannerController@BannerStore');
    Route::get('/banner/edit/{id}', 'Admin\BannerController@BannerEdit');
    Route::post('/banner/edit', 'Admin\BannerController@BannerUpdate');
    Route::post('/banner/delete', 'Admin\BannerController@BannerDelete');
    Route::post('/banner/getJson', 'Admin\BannerController@getJson');


    /*Reviews*/
    Route::get('/reviews', 'Admin\UtilityController@reviewsIndex');
    Route::get('/reviews/add', 'Admin\UtilityController@reviewsAdd');
    Route::post('/reviews/add', 'Admin\UtilityController@reviewsStore');
    Route::get('/reviews/edit/{id}', 'Admin\UtilityController@reviewsEdit');
    Route::post('/reviews/edit', 'Admin\UtilityController@reviewsUpdate');
    Route::post('/reviews/delete', 'Admin\UtilityController@reviewsDelete');
    Route::post('/reviews/getJson', 'Admin\UtilityController@getJson');

    /*Sliders*/
    Route::get('/slider', 'Admin\SliderController@SliderIndex');
    Route::get('/slider/add', 'Admin\SliderController@SliderAdd');
    Route::post('/slider/add', 'Admin\SliderController@SliderStore');
    Route::get('/slider/edit/{id}', 'Admin\SliderController@SliderEdit');
    Route::post('/slider/edit', 'Admin\SliderController@SliderUpdate');
    Route::post('/slider/delete', 'Admin\SliderController@SliderDelete');
    Route::post('/slider/getJson', 'Admin\SliderController@getJson');

    /*Get Coupons*/
    Route::get('/coupons', 'Admin\UtilityController@couponIndex');
    Route::get('/coupons/add', 'Admin\UtilityController@couponAdd');
    Route::post('/coupons/add', 'Admin\UtilityController@couponStore');
    Route::get('/coupons/edit/{id}', 'Admin\UtilityController@couponEdit');
    Route::post('/coupons/edit', 'Admin\UtilityController@couponUpdate');
    Route::post('/coupons/delete', 'Admin\UtilityController@couponDelete');

    /*Get Promo codes*/
    Route::get('/promos', 'Admin\UtilityController@promoIndex');
    Route::get('/promos/add', 'Admin\UtilityController@promoAdd');
    Route::post('/promos/add', 'Admin\UtilityController@promoStore');
    Route::get('/promos/edit/{id}', 'Admin\UtilityController@promoEdit');
    Route::post('/promos/edit', 'Admin\UtilityController@promoUpdate');
    Route::post('/promos/delete', 'Admin\UtilityController@promoDelete');
});
