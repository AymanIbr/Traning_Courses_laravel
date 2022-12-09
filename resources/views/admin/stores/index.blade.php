@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">All Stores</h2>
            @if (session('success'))
                <div class="alert alert-{{session('type')}} alert-dismissible fade show">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
            @endif
@include('admin.layouts.error')
<table class="table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created_At</th>
        <th>Action</th>
    </tr>
    @foreach ( $stores as $store )
    <tr>
        <th>{{$store->id}}</th>
        <th>{{$store->name}}</th>
        <th>{{$store->created_at->format('d - m - Y')}}</th>
        <th>
            <a class="btn btn-primary btn-sm" href="{{route('stores.edit',$store->id)}}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{route('stores.destroy',$store->id)}}" method="POST">
                @csrf
            @method('delete')
            <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
            </form>
        </th>
    </tr>
    @endforeach
</table>
{{$stores->links()}}
</div>
</div>
</div>

@stop
