<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\UploadTrait;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepositoryInterface;


class ProductController extends Controller
{

    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $products;

    public function __construct(ProductRepositoryInterface $products){
        $this->products = $products;
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

        $attributes['cover_image'] = $this->getImagePath('cover_image');
        $attributes['thumbnail'] = $this->getImagePath('thumbnail');

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
            $coverImageName = $product->cover_image;
            Storage::disk('public')->delete($filePath . $coverImageName);

            $attributes['cover_image'] = $this->getImagePath('cover_image');

        }
        if($request->thumbnail){
            $thumbnailName = $product->thumbnail;

            Storage::disk('public')->delete($filePath.$thumbnailName);

            $attributes['thumbnail'] = $this->getImagePath('thumbnail');
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



    /**
     * @param $imageType determines if this is a cover_image or a thumbnail
     * This function gives the uploaded image a new name based on input parameters
     * and returns it's full path to be saved in the database
     * @return string
     */
    protected function getImagePath($imageType){

        $imageName = $imageType.'_'.time();
        $image = request()->file($imageType);
        $folder = '/img/product_images/';
        $filePath = $imageName. '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }
}
