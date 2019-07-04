@extends('admin.layout')

@section('title', 'Add a Product')
@section('description', 'add product content')
@section('content')
    <form method="post" action="/admin/products/{{$product->id}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Enter Product Name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="short_description">Short Description</label>
            <input type="text" class="form-control" name="short_description" id="short_description"
                   placeholder="Enter Product Short Description" value="{{$product->short_description}}">
        </div>
        <div class="form-group">
            <label for="long_description">Main Description</label>
            <textarea class="form-control" id="long_description" name="long_description"
                      placeholder="Enter Product Main Description">{{$product->long_description}}</textarea>
        </div>
        <div class="form-group">
            <label for="cover_photo">Cover Photo</label>
            <input type="text" id="cover_photo" name="cover_photo" class="form-control" value="{{$product->cover_photo}}">
        </div>
        <div class="form-group">
            <label for="alt_tag">Alt Tag</label>
            <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                   name="alt_tag" value="{{$product->alt_tag}}">
        </div>
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control" value="{{$product->thumbnail}}">
        </div>
        <!-- /.box-body -->
        <button type="submit" class="btn btn-primary" style="margin-bottom: 1%">Update Product</button>
    </form>

    <form action="/admin/products/{{$product->id}}" method="post">
        @method('DELETE')
        @csrf
        <div class="form-field">
            <button type="submit" class="btn btn-danger">DELETE PRODUCT</button>
        </div>
    </form>

@endsection
