<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\ParseTextEditorContentTrait;
use Illuminate\Http\Request;
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

    protected $productRepository;
    protected $product;

    public function __construct(ProductRepositoryInterface $products){
        $this->productRepository = $products;
        $this->product = new Product;
    }

    public function index()
    {
        $products = $this->productRepository->all();
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

        $attributes['cover_image'] = $this->product->nameFile('product','cover_image');
        $attributes['thumbnail'] = $this->product->nameFile('product','thumbnail');

        //store the locale value as an indicator of item language
        $attributes['locale'] = session('locale');

        $this->productRepository->create($attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Added'));
    }

    
    public function search(){

        $productName = request('search_string');
        $products = $this->productRepository->find($productName);
        return view('admin.product.index', compact('products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findById($id);
        return view('admin.product.editProduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProductUpdateRequest $request)
    {
        $attributes = $request->validated();
        
        if($request->cover_image){
            $this->product->deleteOldImage($id, 'cover_image');

            $attributes['cover_image'] = $this->product->nameFile('product','cover_image');
        }
        if($request->thumbnail){
            $this->product->deleteOldImage($id, 'thumbnail');

            $attributes['thumbnail'] = $this->product->nameFile('product','thumbnail');
        }

        $this->productRepository->update($id, $attributes);
        return redirect('/admin/products')->with('success', __('Product Successfully Updated'));
    }

    public function status($id){
        $this->productRepository->changeStatus($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect('/admin/products')->with('success', __('Product Successfully Deleted'));
    }
}
