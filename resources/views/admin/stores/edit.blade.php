@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Update Category</h2>
@include('admin.layouts.error')
<form action="{{route('stores.update',$store->id)}}" method="POST">
    @csrf
    @method('put')
    <div class="mb-3">
    <input type="text" placeholder="Name" name="name" class="form-control" value="{{$store->name}}">
</div>
<button class="btn btn-info px-5">Update</button>
</form>
</div>
</div>
</div>

@stop
