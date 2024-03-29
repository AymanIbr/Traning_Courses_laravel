

@extends('Front.layouts.master')

@section('content')



<main>
    <section class="page-header bg-light py-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <ol class="list-unstyled d-flex">
              <li><a href="{{route('homePage')}}">Home</a></li>
              <li class="mx-4">Pay to {{$purchase->product->name}}</li>
            </ol>
            <h1>Pay to {{$purchase->product->name}}</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="courses py-5">
      <div class="container">
        <h3 class="text-center mb-5">
          Welcome {{$purchase->user->name}}, you are now pay for <span class="text-info">{{$purchase->product->name}}</span> with Price
          <span class="text-danger">{{$purchase->product->price}}</span>
        </h3>

        <div class="row">
          <div class="col-md-8">
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container"></div>
              </div>
            </div>
            <script src="https://www.paypal.com/sdk/js?client-id=sb&disable-funding=credit,card&vault=true&components=buttons,marks&currency=USD"></script>
            <!-- <script src="https://www.paypal.com/sdk/js?client-id=sb&components=buttons,marks&currency=USD"></script> -->
            <script>
              function initPayPalButton() {
                paypal.Buttons({
                  style: {
                    shape: 'rect',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',

                  },

                  createOrder: function(data, actions) {
                    return actions.order.create({
                      purchase_units: [{
                        "amount":{
                          "currency_code":"USD",
                          "value":"{{$purchase->product->price}}"
                        }
                      }]
                    });
                  },

                  onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                      // Full available details
                      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                      // Show a success message within this page, e.g.
                      // const element = document.getElementById('paypal-button-container');
                      // element.innerHTML = '';
                      // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                      actions.redirect('{{route('thanks',$purchase->id)}}');
                      // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                  },

                  onError: function(err) {
                    console.log(err);
                  }
                }).render('#paypal-button-container');
              }
              initPayPalButton();
            </script>
          </div>
          <div class="col-md-4">
            <div class="card mb-5 mb-md-0">
              <div class="card-header bg-dark text-white">
                <h5 class="m-0">Order Summary</h5>
              </div>
              <div class="card-body py-2">
                <ul id="orderSummaryList" class="list-unstyled summary">
                  <li>
                    <div class="d-flex justify-content-between">
                      <h5>Course Price</h5>
                      <h5>{{$purchase->product->price}}</h5>
                    </div>
                  </li>
                </ul>
                <hr>
                <div class="d-flex justify-content-between">
                  <h4 class="text-danger">Total</h4>
                  <h4 class="text-danger">{{$purchase->product->price}}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


@stop
