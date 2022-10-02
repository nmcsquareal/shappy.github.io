<!DOCTYPE html>

<html>

<head>
  
    <title></title>
    <base href="/public">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    @include('user.inside_head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
       @include('user.header')
<div class="container">
    
    <h1 class="text-2xl">Balance to pay: ₱{{$totalPrice}}</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 pt-3 shadow-lg font-bold text-2xl">
            <div class="panel panel-default credit-card-box ">
                <div class="panel-heading display-table bg-gradient-to-r from-sky-500 to-indigo-500 p-5" >
                        <h3 class="panel-title text-3xl text-center" >Payment Details</h3>
                </div>
                <div class="panel-body">
    
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form 
                            role="form" 
                            action="{{ route('stripe.post',$totalPrice) }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">

                        @csrf

                        <div class='form-row row p-3 text-3xl '>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label '>Name on Card</label> <input
                                    class='form-control rounded-lg text-2xl border-r-4 border-b-4' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row row p-3  text-3xl'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number rounded-lg text-2xl border-r-4 border-b-4' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row p-3  text-3xl'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>Expiration Month</label> <input autocomplete='off'
                                    class='form-control card-cvc rounded-lg text-2xl border-r-4 border-b-4' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-month rounded-lg text-2xl border-r-4 border-b-4' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>CVC</label> <input
                                    class='form-control card-expiry-year rounded-lg text-2xl border-r-4 border-b-4' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>

                        <div class='form-row row p-3'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-outline-primary btn-lg btn-block text-2xl border-r-4 border-b-4" type="submit">Pay Now</button>
                            </div>
                        </div>
                            
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">


$(function() {

    /*------------------------------------------

    --------------------------------------------

    Stripe Payment Code

    --------------------------------------------

    --------------------------------------------*/

    var $form = $(".require-validation");

     

    $('form.require-validation').bind('submit', function(e) {

        var $form = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',

                         'input[type=text]', 'input[type=file]',

                         'textarea'].join(', '),

        $inputs = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid = true;

        $errorMessage.addClass('hide');

    

        $('.has-error').removeClass('has-error');

        $inputs.each(function(i, el) {

          var $input = $(el);

          if ($input.val() === '') {

            $input.parent().addClass('has-error');

            $errorMessage.removeClass('hide');

            e.preventDefault();

          }

        });

     

        if (!$form.data('cc-on-file')) {

          e.preventDefault();

          Stripe.setPublishableKey($form.data('stripe-publishable-key'));

          Stripe.createToken({

            number: $('.card-number').val(),

            cvc: $('.card-cvc').val(),

            exp_month: $('.card-expiry-month').val(),

            exp_year: $('.card-expiry-year').val()

          }, stripeResponseHandler);

        }

    

    });

      

    /*------------------------------------------

    --------------------------------------------

    Stripe Response Handler

    --------------------------------------------

    --------------------------------------------*/

    function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            /* token contains id, last4, and card type */

            var token = response['id'];

                 

            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }

     

});

</script>


</html>