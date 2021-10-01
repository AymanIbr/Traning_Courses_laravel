@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">All Registration</h2>
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
        <th>Status</th>
        <th>Student Name</th>
        <th>Course Name</th>
        <th>Register_At</th>
        <th>Action</th>
    </tr>
    @foreach ( $data as $record )
    <tr>
        <th>{{$record->id}}</th>
        <th>{{$record->name}}</th>
        <th>{!! $record->status ? '<span class="badeg badge-success" > Completed </span>' : '<span class="badeg badge-warning" > Not Completed </span>' !!}</th>
        <th>{{$record->user->name}}</th>
        <th>{{$record->course->name}}</th>
        <th>{{$record->created_at->format('d - m - Y')}}</th>
        <th>
            <form class="d-inline" action="{{route('registration.destroy',$record->id)}}" method="POST">
                @csrf
            @method('Delete')
            <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
            </form>
        </th>
    </tr>
    @endforeach
</table>
{{$data->links()}}
</div>
</div>
</div>

@stop
