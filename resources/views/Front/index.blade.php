
@extends('Front.layouts.master')

@section('content')

<main>
    <section class="hero">
      <div class="content">
        <h1 class="mb-4 mt-0">We are the top one in the Market</h1>
        <form action="{{route('search')}}" method="POST" >
            @csrf
          <input type="text" name="search" placeholder="Course name.." class="form-control form-control-lg">
        </form>
      </div>
    </section>

    <section class="courses py-5">
      <div class="container">
        <h2 class="text-center mb-4">Our Products</h2>
        <div class="row justify-content-center">
          @foreach ( $products as $product )
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card images">
              <img src="{{asset('uplods/'.$product->image)}}" class="card-img-top" alt="...">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="card-title">{{$product->name}}</h5>
                  <h5>{{$product->price}}</h5>
                </div>
                <p class="card-text">
                    @php
                        echo substr($product->content , 0 , 200).'....'
                    @endphp
                </p>
                <a href="{{route('product',$product->slug)}}" class="btn btn-dark w-100">Go</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
  </main>


@stop
