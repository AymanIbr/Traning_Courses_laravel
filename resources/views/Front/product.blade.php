
@extends('Front.layouts.master')

@section('content')

<main>
    <section class="page-header bg-light py-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <ol class="list-unstyled d-flex">
              <li><a href="https://bakkah.com">Home</a></li>
              <li class="mx-4">{{$product->name}}</li>
            </ol>
            <h1>{{$product->name}}</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="courses py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset('uplods/'.$product->image)}}" class="w-100" alt="">
          </div>
          <div class="col-md-6">
            <h3>{{$product->name}}</h3>
            <h4>Price:{{$product->price}}$</h4>
            <p>{{$product->content}}</p>
            <a class="btn btn-dark px-5" href="{{route('purchase',$product->slug)}}">Purchase</a>
          </div>
        </div>
      </div>
    </section>
  </main>


@stop

