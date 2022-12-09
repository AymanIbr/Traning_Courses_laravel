@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Add New Product</h2>
@include('admin.layouts.error')
<form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
    <input type="text" placeholder="Name" name="name" class="form-control" value="{{old('name')}}">
</div>
<div class="mb-3">
    <input type="text" placeholder="Price" name="price" class="form-control" value="{{old('price')}}">
</div>
<div class="mb-3">
    <textarea class="form-control" placeholder="Content"  name="content" rows="6">{{old('content')}}</textarea>
</div>
<div class="mb-3">
<label>Image</label>
<input type="file" name="image" class="form-control" >
</div>
<div class="mb-3">
  <select name="store_id" class="form-control">
      <option value=""selected disabled>Select Store</option>
      @foreach ( $stores as $store )
<option value="{{$store->id}}">{{$store->name}}</option>
      @endforeach
  </select>
</div>
<button class="btn btn-info px-5">Add</button>
</form>
</div>
</div>
</div>

@stop
