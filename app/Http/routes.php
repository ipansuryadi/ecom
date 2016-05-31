<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web','httpssecure']], function () {

    

    /** Get the Home Page **/
    Route::get('/', 'PagesController@index');

/** Get the Home Page **/
    Route::get('about', 'PagesController@about');

    /** Display Products by category Route **/
    Route::get('category/{id}','PagesController@displayProducts');

    /** Display Products by Brand Route **/
    Route::get('brand/{id}','PagesController@displayProductsByBrand');

    /** Route to post search results **/
    Route::post('/queries', [
        'uses' => '\App\Http\Controllers\QueryController@search',
        'as'   => 'queries.search',
    ]);

    /** Route to Products show page **/
    Route::get('product/{product_name}', [
        'uses' => '\App\Http\Controllers\ProductsController@show',
        'as'   => 'show.product',
    ]);

    /************************************** Order By Routes for Products By Category ***********************************/

    /** Route to sort products by price lowest */
    Route::get('category/{id}/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceLowest',
        'as'   => 'category.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('category/{id}/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceHighest',
        'as'   => 'category.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('category/{id}/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaHighest',
        'as'   => 'category.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('category/{id}/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaLowest',
        'as'   => 'category.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('category/{id}/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsNewest',
        'as'   => 'category.newest',
    ]);


    /************************************** Order By Routes for Products By Brand ***********************************/

    /** Route to sort products by price lowest */
    Route::get('brand/{id}/price/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceLowestBrand',
        'as'   => 'brand.lowest',
    ]);

    /**Route to sort products by price highest */
    Route::get('brand/{id}/price/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsPriceHighestBrand',
        'as'   => 'brand.highest',
    ]);


    /** Route to sort products by alphabetical A-Z */
    Route::get('brand/{id}/alpha/highest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaHighestBrand',
        'as'   => 'brand.alpha.highest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('brand/{id}/alpha/lowest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsAlphaLowestBrand',
        'as'   => 'brand.alpha.lowest',
    ]);

    /**Route to sort products by alphabetical  Z-A */
    Route::get('brand/{id}/newest', [
        'uses' => '\App\Http\Controllers\OrderByController@productsNewestBrand',
        'as'   => 'brand.newest',
    ]);


    /**************************************** Login & Registration Routes *********************************************/

    /** Return view for registration confirm token page ***/
    Route::get('register/confirm/{token}', 'AuthController@confirmEmail');

    Route::get('/register', [
        'uses' => '\App\Http\Controllers\AuthController@getRegister',
        'as'   => 'auth.register',
        'middleware' => ['guest']
    ]);

    Route::post('/register', [
        'uses' => '\App\Http\Controllers\AuthController@postRegister',
        'as'   => 'auth.register',
    ]);

    Route::get('/login', [
        'uses' => '\App\Http\Controllers\AuthController@getLogin',
        'as'   => 'auth.login',
        'middleware' => ['guest']
    ]);

    Route::post('/login', [
        'uses' => '\App\Http\Controllers\AuthController@postLogin',
        'as'   => 'auth.login',
        'middleware' => ['guest'],
    ]);

    Route::get('/logout', [
        'uses' => '\App\Http\Controllers\AuthController@logout',
        'as'   => 'auth.logout'
    ]);

    /**************************
     * Password Reset Routes
     *************************/
    Route::get('/password/email', '\App\Http\Controllers\PasswordController@getEmail');
    Route::post('/password/email', '\App\Http\Controllers\PasswordController@postEmail');
    Route::get('/password/reset/{token}', '\App\Http\Controllers\PasswordController@getReset');
    Route::post('/password/reset', '\App\Http\Controllers\PasswordController@postReset');


    /**************************************** Cart Routes *********************************************/
    
    
    /** Get the view for Cart Page **/
    Route::get('/cart', array(
        'before' => 'auth.basic',
        'as'     => 'cart',
        'uses'   => 'CartController@showCart'
    ));

    /** Add items in the cart **/
    Route::post('/cart/add', array(
        'before' => 'auth.basic',
        'uses'   => 'CartController@addCart'
    ));

    /** Update items in the cart **/
    Route::post('/cart/update', [
        'uses' => 'CartController@update'
    ]);

    /** Delete items in the cart **/
    Route::get('/cart/delete/{id}', array(
        'before' => 'auth.basic',
        'as'     => 'delete_book_from_cart',
        'uses'   => 'CartController@delete'
    ));


    /**************************************** Order Routes *********************************************/


    /** Get thew checkout view **/
    Route::get('/checkout', [
        'uses' => '\App\Http\Controllers\OrderController@index',
        'as'   => 'checkout',
        'middleware' => ['auth'],
    ]);


    /** Post an Order **/
    Route::post('/order',
        array(
            'before' => 'auth.basic',
            'as'     => 'order',
            'uses'   => 'OrderController@postOrder'
        ));


    /******************************************* User Profile Routes below ************************************************/


    /** Resource route for Profile **/
    Route::get('order', ['as'=>'order','uses'=>'ProfileController@index']);
    Route::get('order/confirmation/{id}', 'ProfileController@paymentConfirmation');
    Route::post('order/confirmation', 'ProfileController@postPaymentConfirmation');
    Route::get('profile', ['as'=>'profile','uses'=>'ProfileController@profile']);
    Route::get('profile/add', 'ProfileController@addNewAddress');
    Route::post('profile/post', 'ProfileController@postNewAddress');
    Route::post('profile/delete', 'ProfileController@postDeleteAddress');
    Route::post('profile/kabupaten', 'ProfileController@kabupaten');
    Route::post('profile/kecamatan', 'ProfileController@kecamatan');
    
});



Route::group(["middleware" => 'admin'], function(){

    /** Show the Admin Order **/
   Route::get('admin/order', [
       'uses' => '\App\Http\Controllers\AdminController@order',
       'as'   => 'admin.pages.order',
       'middleware' => ['auth'],
   ]);

   Route::get('admin/order/status/{status}', [
       'uses' => '\App\Http\Controllers\AdminController@status',
       'as'   => 'admin.pages.status',
       'middleware' => ['auth'],
   ]);

   /** Show the Admin Order Verify **/
   Route::get('admin/verify/{id}', [
       'uses' => '\App\Http\Controllers\AdminController@orderVerify',
       'as'   => 'admin.pages.verify',
       'middleware' => ['auth'],
   ]);

   /** Show the Admin Order Verify **/
   Route::post('admin/verify/', [
       'uses' => '\App\Http\Controllers\AdminController@postOrderVerify',
       'as'   => 'admin.pages.postorderverify',
       'middleware' => ['auth'],
   ]);
   /** Show the Admin Order delivery **/
   Route::get('admin/delivery/{id}', [
       'uses' => '\App\Http\Controllers\AdminController@orderDelivery',
       'as'   => 'admin.pages.delivery',
       'middleware' => ['auth'],
   ]);

   /** Show the Admin Order delivery **/
   Route::post('admin/delivery/', [
       'uses' => '\App\Http\Controllers\AdminController@postOrderDelivery',
       'as'   => 'admin.pages.postorderdelivery',
       'middleware' => ['auth'],
   ]);
   /** Show the Admin Order delivery **/
   Route::post('admin/finish/', [
       'uses' => '\App\Http\Controllers\AdminController@finishTransaction',
       'as'   => 'admin.pages.finishtransaction',
       'middleware' => ['auth'],
   ]);


    /** Show the Admin User **/
   Route::get('admin/user', ['uses' => '\App\Http\Controllers\AdminController@user','as'   => 'admin.pages.user','middleware' => ['auth'],]);


   /** Show the Admin Dashboard **/
   Route::get('admin/dashboard', [
       'uses' => '\App\Http\Controllers\AdminController@index',
       'as'   => 'admin.pages.index',
       'middleware' => ['auth'],
   ]);

    /** Show the Admin Categories **/
    Route::get('admin/categories', [
        'uses' => '\App\Http\Controllers\CategoriesController@showCategories',
        'as'   => 'admin.category.show',
        'middleware' => ['auth'],
    ]);

    /** Show the Admin Add Categories Page **/
    Route::get('admin/categories/add', [
        'uses' => '\App\Http\Controllers\CategoriesController@addCategories',
        'as'   => 'admin.category.add',
        'middleware' => ['auth'],
    ]);

    /** Post the Category Route **/
    Route::post('admin/categories/add', [
        'uses' => '\App\Http\Controllers\CategoriesController@addPostCategories',
        'as'   => 'admin.category.post',
        'middleware' => ['auth'],
    ]);

    /** Show the Admin Edit Categories Page **/
    Route::get('admin/categories/edit/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@editCategories',
        'as'   => 'admin.category.edit',
        'middleware' => ['auth'],
    ]);

    /** Show the Admin Update Categories Page **/
    Route::post('admin/categories/update/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@updateCategories',
        'as'   => 'admin.category.update',
        'middleware' => ['auth'],
    ]);

    /** Delete a category **/
    Route::delete('admin/categories/delete/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@deleteCategories',
        'as'   => 'admin.category.delete',
        'middleware' => ['auth'],
    ]);

    // show admin slideshow
   Route::get('admin/slideshow', [
        'uses'  =>  '\App\Http\Controllers\SlideshowController@index',
        'as'    =>  'admin.slideshow.index',
        'middleware'    =>  ['auth'],
    ]);

    Route::get('admin/slideshow/add', [
        'uses'  =>  '\App\Http\Controllers\SlideshowController@add',
        'as'    =>  'admin.slideshow.add',
        'middleware'    =>  ['auth'],
    ]);

    Route::get('admin/slideshow/edit/{id}', [
        'uses'  =>  '\App\Http\Controllers\SlideshowController@edit',
        'as'    =>  'admin.slideshow.edit',
        'middleware'    =>  ['auth'],
    ]);

    Route::patch('admin/slideshow/update/{id}', [
        'uses'  =>  '\App\Http\Controllers\SlideshowController@update',
        'as'    =>  'admin.slideshow.update',
        'middleware'    =>  ['auth'],
    ]);

    Route::post('admin/slideshow/post', [
        'uses'  =>  '\App\Http\Controllers\SlideshowController@post',
        'as'    =>  'admin.slideshow.post',
        'middleware'    =>  ['auth'],
    ]);

   Route::delete('admin/slideshow/delete/{id}',[
        'uses'  =>  '\App\Http\Controllers\SlideshowController@delete',
        'as'    =>  'admin.slideshow.delete',
        'middleware'    =>  ['auth'],
    ]);

    /****************************************Sub-Category Routes below ***********************************************/


    /** Show the Admin Add Sub-Categories Page **/
    Route::get('admin/categories/addsub/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@addSubCategories',
        'as'   => 'admin.category.addsub',
        'middleware' => ['auth'],
    ]);

    /** Post the Sub-Category Route **/
    Route::post('admin/categories/postsub/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@addPostSubCategories',
        'as'   => 'admin.category.postsub',
        'middleware' => ['auth'],
    ]);

    /** Show the Admin Edit Categories Page **/
    Route::get('admin/categories/editsub/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@editSubCategories',
        'as'   => 'admin.category.editsub',
        'middleware' => ['auth'],
    ]);

    /** Post the Sub-Category update Route**/
    Route::post('admin/categories/updatesub/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@updateSubCategories',
        'as'   => 'admin.category.updatesub',
        'middleware' => ['auth'],
    ]);


    /** Delete a sub-category **/
    Route::delete('admin/categories/deletesub/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@deleteSubCategories',
        'as'   => 'admin.category.deletesub',
        'middleware' => ['auth'],
    ]);


    /** Get all the products under a sub-category route **/
    Route::get('admin/categories/products/cat/{id}', [
        'uses' => '\App\Http\Controllers\CategoriesController@getProductsForSubCategory',
        'as'   => 'admin.category.products',
        'middleware' => ['auth'],
    ]);

    /** Route for the sub-category drop-down */
    Route::get('api/dropdown', 'ProductsController@categoryAPI');


    /******************************************* Products Routes below ************************************************/


    /** Show the Admin Products Page **/
    Route::get('admin/products', [
        'uses' => '\App\Http\Controllers\ProductsController@showProducts',
        'as'   => 'admin.product.show',
        'middleware' => ['auth'],
    ]);

    /** Show the Admin Add product Page **/
    Route::get('admin/product/add', [
        'uses' => '\App\Http\Controllers\ProductsController@addProduct',
        'as'   => 'admin.product.add',
        'middleware' => ['auth'],
    ]);


    /** Post the Add Product Route **/
    Route::post('admin/product/add', [
        'uses' => '\App\Http\Controllers\ProductsController@addPostProduct',
        'as'   => 'admin.product.post',
        'middleware' => ['auth'],
    ]);


    /** Get the Edit product Page **/
    Route::get('admin/product/edit/{id}', [
        'uses' => '\App\Http\Controllers\ProductsController@editProduct',
        'as'   => 'admin.product.edit',
        'middleware' => ['auth'],
    ]);

    /** Post the Admin Update Product Route **/
    Route::post('admin/product/update/{id}', [
        'uses' => '\App\Http\Controllers\ProductsController@updateProduct',
        'as'   => 'admin.product.update',
        'middleware' => ['auth'],
    ]);

    /** Delete a product **/
    Route::delete('admin/product/delete/{id}', [
        'uses' => '\App\Http\Controllers\ProductsController@deleteProduct',
        'as'   => 'admin.product.delete',
        'middleware' => ['auth'],
    ]);

    /** Get the Admin Upload Images Page **/
    Route::get('admin/products/{id}', [
        'uses' => '\App\Http\Controllers\ProductsController@displayImageUploadPage',
        'as'   => 'admin.product.upload',
        'middleware' => ['auth'],
    ]);

    /** Post a photo to a Product **/
    Route::post('admin/products/{id}/photo', 'ProductPhotosController@store');

    /** Delete Product photos **/
    Route::delete('admin/products/photos/{id}', 'ProductPhotosController@destroy');

    /** Post the Product Add Featured Image Route **/
    Route::post('admin/products/add/featured/{id}', 'ProductPhotosController@storeFeaturedPhoto');

    /*search product*/

    Route::post('admin/products/search', [
        'uses' => '\App\Http\Controllers\ProductsController@search',
        'as' => 'admin.product.search',
        'middleware' => ['auth'],
        ]);
    /*show product by brand*/
    Route::get('admin/products/order/{brand_id}',[
        'uses' => '\App\Http\Controllers\ProductsController@brand',
        'as' => 'admin.product.brand',
        'middleware' => ['auth'],
        ]);
    Route::get('admin/products/order/{brand_id}/newest',[
        'uses' => '\App\Http\Controllers\ProductsController@newest',
        'as' => 'admin.product.newest',
        'middleware' => ['auth'],
        ]);

    Route::get('admin/products/order/{brand_id}/oldest',[
        'uses' => '\App\Http\Controllers\ProductsController@oldest',
        'as' => 'admin.product.oldest',
        'middleware' => ['auth'],
        ]);

    Route::get('admin/products/order/{brand_id}/price/highest',[
        'uses' => '\App\Http\Controllers\ProductsController@highest',
        'as' => 'admin.product.highest',
        'middleware' => ['auth'],
        ]);

    Route::get('admin/products/order/{brand_id}/price/lowest',[
        'uses' => '\App\Http\Controllers\ProductsController@lowest',
        'as' => 'admin.product.lowest',
        'middleware' => ['auth'],
        ]);

    Route::get('admin/products/order/{brand_id}/alpha/asc',[
        'uses' => '\App\Http\Controllers\ProductsController@asc',
        'as' => 'admin.product.asc',
        'middleware' => ['auth'],
        ]);
    
    Route::get('admin/products/order/{brand_id}/alpha/desc',[
        'uses' => '\App\Http\Controllers\ProductsController@desc',
        'as' => 'admin.product.desc',
        'middleware' => ['auth'],
        ]);

    Route::get('admin/products/order/{brand_id}/stock/asc',[
        'uses' => '\App\Http\Controllers\ProductsController@stock',
        'as' => 'admin.product.stock',
        'middleware' => ['auth'],
        ]);

    /******************************************* Brands Routes below ************************************************/

    
    /** Resource route for Admin Brand Actions **/
    Route::resource('admin/brands', 'BrandsController');

    /** Delete a Brand **/
    Route::delete('admin/brands/delete/{id}', [
        'uses' => '\App\Http\Controllers\BrandsController@delete',
        'as'   => 'admin.brand.delete',
        'middleware' => ['auth'],
    ]);

    /** Get all the products under a brand route **/
    Route::get('admin/brands/products/brand/{id}', [
        'uses' => '\App\Http\Controllers\BrandsController@getProductsForBrand',
        'as'   => 'admin.brand.products',
        'middleware' => ['auth'],
    ]);


    /** Delete a user **/
    Route::delete('admin/dashboard/delete/{id}', [
        'uses' => '\App\Http\Controllers\AdminController@delete',
        'as'   => 'admin.delete',
        'middleware' => ['auth'],
    ]);

    /** Delete a cart session **/
    Route::delete('admin/dashboard/cart/delete/{id}', [
        'uses' => '\App\Http\Controllers\AdminController@deleteCart',
        'as'   => 'admin.cart.delete',
        'middleware' => ['auth'],
    ]);


    /** Update quantity from prducts in Admin dashboard **/
    Route::post('/admin/update', [
        'uses' => 'AdminController@update'
    ]);

    //shipping
    Route::resource('admin/shipping', 'ShippingController');
// GET|HEAD  | admin/shipping                 | admin.shipping.index   | App\Http\Controllers\ShippingController@index    
// POST      | admin/shipping                 | admin.shipping.store   | App\Http\Controllers\ShippingController@store    
// GET|HEAD  | admin/shipping/create          | admin.shipping.create  | App\Http\Controllers\ShippingController@create   
// DELETE    | admin/shipping/{shipping}      | admin.shipping.destroy | App\Http\Controllers\ShippingController@destroy  
// PUT|PATCH | admin/shipping/{shipping}      | admin.shipping.update  | App\Http\Controllers\ShippingController@update   
// GET|HEAD  | admin/shipping/{shipping}      | admin.shipping.show    | App\Http\Controllers\ShippingController@show     
// GET|HEAD  | admin/shipping/{shipping}/edit | admin.shipping.edit    | App\Http\Controllers\ShippingController@edit  
    Route::post('admin/shipping/search', [
        'uses' => '\App\Http\Controllers\ShippingController@search',
        'as' => 'admin.shipping.search',
        'middleware' => ['auth'],
    ]);

    Route::resource('admin/bank', 'BankController');
    
    Route::get('admin/config', [
        'uses'=> '\App\Http\Controllers\ConfigController@index',
        'middleware'=> ['auth'],
        'as'=> 'admin.config.index'
        ]);
    Route::post('admin/config', [
        'uses'=> '\App\Http\Controllers\ConfigController@store',
        'middleware'=> ['auth'],
        'as'=> 'admin.config.store'
        ]);
    Route::resource('admin/static', 'StaticPageController');
    /*
POST    admin/static                 | admin.static.store     | App\Http\Controllers\StaticPageController@store
GET     admin/static                 | admin.static.index     | App\Http\Controllers\StaticPageController@index
GET     admin/static/create          | admin.static.create    | App\Http\Controllers\StaticPageController@create
PUT     admin/static/{static}        | admin.static.update    | App\Http\Controllers\StaticPageController@update
GET     admin/static/{static}        | admin.static.show      | App\Http\Controllers\StaticPageController@show
DELETE  admin/static/{static}        | admin.static.destroy   | App\Http\Controllers\StaticPageController@destroy
GET     admin/static/{static}/edit   | admin.static.edit      | App\Http\Controllers\StaticPageController@edit 
*/
});

Route::group(['middleware' => ['super']], function(){
    $option = [
        'uses'=>'\App\Http\Controllers\PagesController@super',
        'middleware'=>['auth'],
        'as'=>'superadmin'
    ];
    Route::get('super', $option);
});