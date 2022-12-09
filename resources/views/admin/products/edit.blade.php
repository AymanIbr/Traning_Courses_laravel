@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Update Product</h2>
@include('admin.layouts.error')
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
        <div class="mb-3">
        <input type="text" placeholder="Name" name="name" class="form-control" value="{{$product->name}}">
    </div>
    <div class="mb-3">
        <input type="text" placeholder="Price" name="price" class="form-control"value="{{$product->price}}">
    </div>
    <div class="mb-3">
        <textarea class="form-control" placeholder="Content"  name="content" rows="6">{{$product->content}}</textarea>
    </div>
    <div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control" >
    <img class="mt-1" width="80" src="{{asset('uplods/'.$product->image)}}" alt="">
    </div>
    <div class="mb-3">
      <select name="store_id" class="form-control mb-4">
          <option value=""selected disabled>Select Store</option>
          @foreach ( $stores as $store )
    <option {{$store->id == $product->store->id ? 'selected' : '' }} value="{{$store->id}}" >{{$store->name}}</option>
          @endforeach
      </select>
    </div>
<button class="btn btn-info px-5">Update</button>
</form>
</div>
</div>
</div>

@stop
