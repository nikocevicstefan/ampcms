<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\UploadTrait;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
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
    public function store()
    {
        $attributes = request()->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:2|max:50',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:2|max:255',
            'short_description' => 'required|min:6|max:255',
            'intro_text' => 'required|min:6|max:255',
            'main_text' => 'required|min:12',
            'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $coverImagePath = $this->getImagePath('cover_image');
        $thumbnailPath = $this->getImagePath('thumbnail');
        $attributes['cover_image'] = $coverImagePath;
        $attributes['thumbnail'] = $thumbnailPath;

        //store the locale value as an indicator of item language
        $attributes['locale'] = session('locale');

        $product = Product::create($attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    public function search(){
        $productName = request('search_string');
        $products = Product::where('name', 'LIKE', '%'.$productName.'%')->paginate(10);
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
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'alt_tag' => 'required|alpha_dash|min:2|max:50',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:2|max:255',
            'short_description' => 'required|min:6|max:255',
            'intro_text' => 'required|min:6|max:255',
            'main_text' => 'required|min:12',
        ]);

        $filePath = 'img/product_images/';
        
        

        if(request('cover_image')){
            $coverImageName = $product->cover_image;
            Storage::disk('public')->delete($filePath . $coverImageName);

            $coverImagePath = $this->getImagePath('cover_image');
            $attributes['cover_image'] = $coverImagePath;

        }
        if(request('thumbnail')){
            $thumbnailName = $product->thumbnail;
            Storage::disk('public')->delete($filePath.$thumbnailName);

            $thumbnailPath = $this->getImagePath('thumbnail');
            $attributes['thumbnail'] = $thumbnailPath;
        }

        $product->update($attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Updated'));
    }

    public function status(Product $product){
        $product->status = !$product->status;
        $product->update();
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
        $product->delete();
        return redirect('/admin/products')->with('success', __('Product Successfully Deleted'));
    }


    /**
     * @param $imageType determines if this is a cover_image or a thumbnail
     * This function gives the uploaded image a new name based on input parameters
     * and returns it's full path to be saved in the database
     * @return string
     */
    protected function getImagePath($imageType){

        $validateImage = request()->validate([
            $imageType => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $imageName = $imageType.'_'.time();
        $image = request()->file($imageType);
        $folder = '/img/product_images/';
        $filePath = $imageName. '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }
}
