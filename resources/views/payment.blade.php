
@extends('component.master')
@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                    <!-- Credit card form tabs -->
                    <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#credit-card" class="nav-link active"> <img src="{{url('/gateway/jazz.png')}}" class="rounded-circle" style="height:30px;width:40px;" > JazzCash </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#paypal" class="nav-link"> <i class="fab fa-paypal mr-2"></i>Paypal</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#net-banking" class="nav-link"> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#stripe" class="nav-link"> <i class="fab fa-stripe mr-2"></i> Stripe </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#razorpay" class="nav-link"> <i class="fab fa-buildings"></i> Razor pay </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#flutterwave" class="nav-link"> <i class="fab fa-buildings"></i>Flutter Wave</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#applepay" class="nav-link"> <i class="fab fa-buildings"></i> Apple Pay </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#mollie" class="nav-link"> <i class="fab fa-buildings"></i>Mollie </a>
                        </li>
                    </ul>
                </div>
                <!-- End -->
                <!-- Credit card form content -->
                <div class="tab-content">
                    <!-- credit card info-->
                    <div id="credit-card" class="tab-pane fade show active pt-3">
                        <form name="jazzcash" id="jazzcash" action="{{ route('jazzCash') }}"  method="Post" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">
                                    <h6>Card Owner</h6>
                                </label>
                                <input type="text" name="username" placeholder="Card Owner Name" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="billref">
                                    <h6>Billref number</h6>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="billref" placeholder="Valid billref" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted">  <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6> Product Description</h6>
                                            </span>
                                        </label>
                                        <div class="input-group"><textarea type="text" width="" height="100px" placeholder="productDescription" name="productDescription" class="form-control" required > </textarea></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>Amount <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" name="amount" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button>
                            </div>
                        </form>
                    </div>
                    <!-- End -->
                     <!-- razorpay info-->
                     <div id="razorpay" class="tab-pane fade show pt-3">

                        <h2 class="mt-3" >Pay With Razorpay</h2>
                        <form class="mt-5" action="{{ route('razorpay') }}"  method="Post" >
                          
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZOR_KEY') }}"
                                data-amount="1000"
                                data-buttontext="Confirm Payment 10$"
                                data-name="Usman"
                                data-description="Payment"                                
                                data-prefill.name="name"
                                data-prefill.email="email"
                                data-theme.color="#ff7529">
                        </script>
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">

                        </form>
                    </div>
                    <!-- End -->
                    <!-- Apple info-->
                    <div id="apple" class="tab-pane fade show pt-3">

                        <h2 class="mt-3" >Pay With Flutter wave</h2>
                        <form name="apple_pay" id="apple_pay" action="{{}}"  method="Post" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">
                                    <h6>Name</h6>
                                </label>
                                <input type="text" name="username" placeholder="Card Owner Name" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    <h6>Email</h6>
                                </label>
                                <div class="input-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted">  <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    <h6>Phone</h6>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted">  <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6> Product Description</h6>
                                            </span>
                                        </label>
                                        <div class="input-group"><textarea type="text" width="" height="100px" placeholder="productDescription" name="productDescription" class="form-control" required > </textarea></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>Amount <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" name="amount" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button>
                            </div>
                        </form>
                    </div>
                    <!-- End -->
                    <!-- flutterwave info-->
                    <div id="flutterwave" class="tab-pane fade show pt-3">

                        <h2 class="mt-3" >Pay With Flutter wave</h2>
                        <form name="flutter_wave" id="flutter_wave" action="javascript:void(0);"  method="Post" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">
                                    <h6>Name</h6>
                                </label>
                                <input type="text" name="username" placeholder="Card Owner Name" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    <h6>Email</h6>
                                </label>
                                <div class="input-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted">  <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    <h6>Phone</h6>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted">  <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6> Product Description</h6>
                                            </span>
                                        </label>
                                        <div class="input-group"><textarea type="text" width="" height="100px" placeholder="productDescription" name="productDescription" class="form-control" required > </textarea></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>Amount <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" name="amount" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button>
                            </div>
                        </form>
                    </div>
                    <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <h6 class="pb-2">Select your paypal account type</h6>
                        <form action="{{ route('charge') }}" method="Post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <input type="number" required class="form-control" name="amount" id="amount" />
                         </div>
                        <p>
                            <input type="submit" class="btn-lg btn-primary fab fa-paypal form-control" value="Pay With Paypal" />
                        </p>
                        </form>
                        <p class="text-muted">
                            Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                        </p>
                    </div>
                    <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group">
                            <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label>
                            <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank 1</option>
                                <option>Bank 2</option>
                                <option>Bank 3</option>
                                <option>Bank 4</option>
                                <option>Bank 5</option>
                                <option>Bank 6</option>
                                <option>Bank 7</option>
                                <option>Bank 8</option>
                                <option>Bank 9</option>
                                <option>Bank 10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p>
                                <button type="button" class="btn btn-primary"><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</button>
                            </p>
                        </div>
                        <p class="text-muted">
                            Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                        </p>
                    </div>
                    <!-- End -->
                     <!-- stripe transfer info -->
                     <div id="stripe" class="tab-pane fade pt-3">
                        <h6 class="error"></h6>
                        <p class='has-error'></p>
                        <form role="form"  action="{{ route('stripe.post') }}"  method="post"  class="require-validation" data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <input type="hidden" name="user_id" value="1" id="user_id" >
                        <input type="hidden" name="amount" id="amount" value="100" >
                            <div class="form-group">
                                <label for="username">
                                    <h6>Card Owner</h6>
                                </label>
                                <input type="text" name="username" size='25' placeholder="Card Owner Name" required class="form-control" maxlength="30" />
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">
                                    <h6>Card number</h6>
                                </label>
                                <div class="input-group">
                                    <input type="text" placeholder="Valid card number" id="c-n" pattern="\d*" class="form-control card-number" maxlength="16" onkeypress="return checkDigit(event)" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6>Expiration Date</h6>
                                            </span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" placeholder="MM"  class="form-control card-expiry-month" maxlength="2" onkeypress="return checkDigit(event)" required />
                                             <input type="text" placeholder="YY" maxlength="2" class="form-control card-expiry-year" onkeypress="return checkDigit(event)" required />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" required id="cc" class="form-control card-cvc" maxlength="4" onkeypress="return checkDigit(event)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"><button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Confirm Payment</button></div>
                        </form>
                        <p class="text-muted">
                            Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order.
                        </p>
                    </div>
                    <!-- End -->
                     
                    <!-- End -->
                </div>
            </div>
        </div>
    </div>
</div> 

{{-- Model Form Flutter Wave --}}

<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" top="20"  role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Flutter Wave Payment Proceed</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      <h6>Please Click On Button And Proceed To Pay Tab</h6>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <a href=""  class="btn btn-outline-warning" id="link_pay" target='blank' value=''>Confirm Payment</a>
      </div>
    </div>
  </div>
</div>



{{--END--}}

@endsection

@section('footer')
<script>
$("#flutter_wave").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "{{ route('flutter_wave') }}",
        type: 'post',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
         contentType: false,
        processData: false, 
        success: function(msg) {    
    $('#modalRegisterForm').modal('show');
       var text = 'Confirm Payment';
        $("#link_pay").html(`<a href="${msg}" class="btn btn-outline-warning" target="_blank">${text}</a>`);
    
         
        }
    });
});
</script>
@endsection