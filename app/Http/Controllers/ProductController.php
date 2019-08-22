<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepositoryInterface;


class ProductController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $products;
    protected $productInstance;

    public function __construct(ProductRepositoryInterface $products){
        $this->products = $products;
        $this->productInstance = new Product;
    }

    public function index()
    {
        $products = $this->products->all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $attributes = $request->validated();

        $attributes['cover_image'] = $this->productInstance->nameFile('product','cover_image');
        $attributes['thumbnail'] = $this->productInstance->nameFile('product','thumbnail');

        //store the locale value as an indicator of item language
        $attributes['locale'] = session('locale');

        $this->products->create($attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Added'));
    }

    
    public function search(){

        $productName = request('search_string');
        $products = $this->products->find($productName);
        return view('admin.product.index', compact('products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.editProduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductUpdateRequest $request)
    {
        $attributes = $request->validated();

        $filePath = 'img/product_images/';
        
        if($request->cover_image){
            Storage::disk('public')->delete($filePath . $product->cover_image);

            $attributes['cover_image'] = $this->productInstance->nameFile('product','cover_image');
        }
        if($request->thumbnail){
            Storage::disk('public')->delete($filePath . $product->thumbnail);

            $attributes['thumbnail'] = $this->productInstance->nameFile('product','thumbnail');
        }

        $this->products->update($product, $attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Updated'));
    }

    public function status(Product $product){
        $product->status = !$product->status;
        $this->products->changeStatus($product);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $this->products->delete($product);
        return redirect('/admin/products')->with('success', __('Product Successfully Deleted'));
    }
}
