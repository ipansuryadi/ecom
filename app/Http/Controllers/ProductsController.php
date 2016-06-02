<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductEditRequest;

use App\Http\Traits\BrandAllTrait;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\SearchTrait;
use App\Http\Traits\CartTrait;


class ProductsController extends Controller {

    use BrandAllTrait, CategoryTrait, SearchTrait, CartTrait;


    /**
     * Show all products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProducts() {

        // Get all latest products, and paginate them by 10 products per page
        $product = Product::latest('created_at')->paginate(30);

        // Count all Products in Products Table
        $productCount = Product::all()->count();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        $brand_query = 0;
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }

    public function search(){
        $query = htmlspecialchars_decode(Input::get('search'));
        $search_result = Product::where('product_name', 'LIKE', '%' . $query . '%')->paginate(30);
        $product = $search_result;
        $productCount = $search_result->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        $brand_query = $search_result;
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brand_query', 'brands'));
    }

    /*Show all products in admin dashboard by brands*/

    public function brand($brand_id){
        $brand_query = $brand_id;
        $product = Product::where('brand_id',$brand_id)->paginate(30);
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands', 'brand_query'));
    }

    public function newest($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::latest()->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::latest()->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }

    public function oldest($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::oldest()->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::oldest()->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }
    public function highest($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::orderBy('reduced_price','desc')->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::orderBy('reduced_price','desc')->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }
    public function lowest($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::orderBy('reduced_price','asc')->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::orderBy('reduced_price','asc')->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }
    public function asc($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::orderBy('product_name','asc')->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::orderBy('product_name','asc')->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }
    public function desc($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::orderBy('product_name','desc')->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::orderBy('product_name','desc')->paginate(30);
        }
        $productCount = $product->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }
    public function stock($brand_id){
        $brand_query = $brand_id;
        if ($brand_id > 0) {
            $product = Product::orderBy('product_qty')->where('brand_id',$brand_id)->paginate(30);
        } else {
            $product = Product::orderBy('product_qty')->paginate(30);
        }
        $productCount = Product::all()->count();
        $cart_count = $this->countProductsInCart();
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        $search = Product::all();
        $brands = Brand::all();
        return view('admin.product.show', compact('productCount', 'product', 'cart_count', 'rand_brands', 'search', 'brands','brand_query'));
    }

    /**
     * Return the view for add new product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct() {
        // From Traits/CategoryTrait.php
        // ( This is to populate the parent category drop down in create product page )
        $categories = $this->parentCategory();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->brandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
$rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        return view('admin.product.add', compact('categories', 'brands', 'cart_count', 'rand_brands'));
    }


    /**
     * Add a new product into the Database.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPostProduct(ProductRequest $request) {

        // Check if checkbox is checked or not for featured product
        $featured = Input::has('featured') ? true : false;

        // Replace any "/" with a space.
        $product_name =  str_replace("/", " " ,$request->input('product_name'));

       // if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
        //    flash()->error('Error', 'Cannot create Product because you are signed in as a test user.');
       // } else {
            // Create the product in DB
            $product = Product::create([
                'product_name' => $product_name,
                'product_qty' => $request->input('product_qty'),
                'product_sku' => $request->input('product_sku'),
                'price' => $request->input('price'),
                'reduced_price' => $request->input('reduced_price'),
                'cat_id' => $request->input('cat_id'),
                'brand_id' => $request->input('brand_id'),
                'featured' => $featured,
                'description' => $request->input('description'),
                'product_spec' => $request->input('product_spec'),
                'weight' => $request->input('weight'),
            ]);

            // Save the product into the Database.
            $product->save();

            // Flash a success message
            flash()->success('Success', 'Product created successfully!');
       // }


        // Redirect back to Show all products page.
        return redirect()->route('admin.product.show');
    }


    /**
     * This method will fire off when a admin chooses a parent category.
     * It will get the option and check all the children of that parent category,
     * and then list them in the sub-category drop-down.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryAPI() {
        // Get the "option" value from the drop-down.
        $input = Input::get('option');

        // Find the category name associated with the "option" parameter.
        $category = Category::find($input);

        // Find all the children (sub-categories) from the parent category
        // so we can display then in the sub-category drop-down list.
        $subcategory = $category->children();

        // Return a Response, and make a request to get the id and category (name)
        return \Response::make($subcategory->get(['id', 'category']));
    }


    /**
     * Return the view to edit & Update the Products
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct($id) {

        // Find the product ID
        $product = Product::where('id', '=', $id)->find($id);

        // If no product exists with that particular ID, then redirect back to Show Products Page.
        if (!$product) {
            return redirect('admin/products');
        }

        // From Traits/CategoryTrait.php
        // ( This is to populate the parent category drop down in create product page )
        $categories = $this->parentCategory();

        // From Traits/BrandAll.php
        // Get all the Brands
        $brands = $this->BrandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
$rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        // Return view with products and categories
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'cart_count', 'rand_brands'));

    }


    /**
     * Update a Product
     *
     * @param $id
     * @param ProductEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct($id, ProductEditRequest $request) {

        // Check if checkbox is checked or not for featured product
        $featured = Input::has('featured') ? true : false;

        // Find the Products ID from URL in route
        $product = Product::findOrFail($id);


        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot edit Product because you are signed in as a test user.');
        } else {
            // Update product
            $product->update(array(
                'product_name' => $request->input('product_name'),
                'product_qty' => $request->input('product_qty'),
                'product_sku' => $request->input('product_sku'),
                'price' => $request->input('price'),
                'reduced_price' => $request->input('reduced_price'),
                'cat_id' => $request->input('cat_id'),
                'brand_id' => $request->input('brand_id'),
                'featured' => $featured,
                'description' => $request->input('description'),
                'product_spec' => $request->input('product_spec'),
                'weight' => $request->input('weight'),
            ));


            // Update the product with all the validation rules
            $product->update($request->all());

            // Flash a success message
            flash()->success('Success', 'Product updated successfully!');
        }

        // Redirect back to Show all categories page.
        return redirect()->route('admin.product.show');
    }


    /**
     * Delete a Product
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id) {

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete Product because you are signed in as a test user.');
        } else {
            // Find the product id and delete it from DB.
            Product::findOrFail($id)->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }


    /**
     * Display the form for uploading images for each Product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayImageUploadPage($id) {

        // Get the product ID that matches the URL product ID.
        $product = Product::where('id', '=', $id)->get();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
$rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();
        return view('admin.product.upload', compact('product', 'cart_count', 'rand_brands'));
    }


    /**
     * Show a Product in detail
     *
     * @param $product_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($product_name) {

        // Find the product by the product name in URL
        $product = Product::ProductLocatedAt($product_name);
        
        // From Traits/SearchTrait.php
        // Enables capabilities search to be preformed on this view )
        $search = Product::all();

        // From Traits/CategoryTrait.php
        // ( Show Categories in side-nav )
        $categories = $this->categoryAll();

        // Get brands to display left nav-bar
        $brands = $this->BrandsAll();

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
        
        $rand_brands = Brand::orderByRaw('RAND()')->take(6)->get();

        $similar_product = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', '=', $product->brand_id)
                    ->orWhere('cat_id', '=', $product->cat_id);
            })->get();
        \DB::table('products')->where('id',$product->id)->increment('hits', 1);
        return view('pages.show_product', compact('product', 'search', 'brands', 'categories', 'similar_product', 'cart_count', 'rand_brands'));
    }

}