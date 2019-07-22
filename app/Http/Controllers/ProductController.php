<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\UploadTrait;
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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:2|max:50',
            'name' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:2|max:255',
            'short_description' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:6|max:255',
            'intro_text' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:6|max:255',
            'main_text' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:12',
            'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $coverPhotoPath = $this->getPhotoPath('product', 'cover_photo');
        $thumbnailPath = $this->getPhotoPath('product', 'thumbnail');
        $attributes['cover_photo'] = $coverPhotoPath;
        $attributes['thumbnail'] = $thumbnailPath;

        $product = Product::create($attributes);
        return redirect('/admin/products')->with('success', 'Product Successfully Added');
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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:2|max:50',
            'name' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:2|max:255',
            'short_description' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:6|max:255',
            'intro_text' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:6|max:255',
            'main_text' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|min:12',
            'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $filePath = 'img/product_photos/';
        $coverPhotoName = $product->cover_photo;
        Storage::disk('public')->delete($filePath.$coverPhotoName);
        $thumbnailName = $product->thumbnail;
        Storage::disk('public')->delete($filePath.$thumbnailName);


        $coverPhotoPath = $this->getPhotoPath('product', 'cover_photo');
        $thumbnailPath = $this->getPhotoPath('product', 'thumbnail');
        $attributes['cover_photo'] = $coverPhotoPath;
        $attributes['thumbnail'] = $thumbnailPath;


        $product->update($attributes);
        return redirect('/admin/products');
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
        return redirect('/admin/products');
    }

    protected function getPhotoPath($name, $request){

        $photoName = $name.'_'.$request.'_'.time();
        $validatePhoto = request()->validate([
            $request => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $photo = request()->file($request);
        $folder = '/img/product_photos/';
        $filePath = $photoName. '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public', $photoName);

        return $filePath;
    }
}
