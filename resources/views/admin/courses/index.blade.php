@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">All Courses</h2>
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
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Created_At</th>
        <th>Action</th>
    </tr>
    @foreach ( $courses as $course )
    <tr>
        <th>{{$course->id}}</th>
        <th>
            <img width="80" src="{{asset('uplods/'.$course->image)}}" alt="">
        </th>
        <th>{{$course->name}}</th>
        <th>{{$course->price}}</th>
        <th>{{$course->category->name}}</th>
        <th>{{$course->created_at->format('d - m - Y')}}</th>
        <th>
            <a class="btn btn-primary btn-sm" href="{{route('courses.edit',$course->id)}}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{route('courses.destroy',$course->id)}}" method="POST">
                @csrf
            @method('delete')
            <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
            </form>
        </th>
    </tr>
    @endforeach
</table>
{{$courses->links()}}
</div>
</div>
</div>

@stop
