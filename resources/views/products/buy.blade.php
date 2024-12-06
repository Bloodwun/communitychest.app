@extends('user.layouts.master')

@section('content')
    <div class="container">
        <h1 class="checkout-title">Checkout</h1>

        <!-- Include Stripe.js -->
        <script src="https://js.stripe.com/v3/"></script>

        <div class="checkout-container bg-light">
            <form action="{{ route('business.products.createOrder', ['product' => $product->id]) }}" method="POST"
                id="payment-form">
                @csrf

                <!-- Display Product Information -->
                <h2 class="product-name">{{ $product->name }}</h2>
                <p class="product-price">${{ number_format($product->price, 2) }}</p>

                <!-- Stripe Card Element -->
                <div id="card-element" class="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert" class="error-message"></div>

                <button id="submit" type="submit" class="btn btn-primary btn-pay-now">Pay Now</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript">
            // Set up Stripe.js and Elements to use in the form
            var stripe = Stripe(
                'pk_test_51MVCGyFaWK1ZSTpIH9lWMYoVJ9YZ2oLOV4LIJQbjwebRUPHRGiaA2jpDFY5CuRDyzrN0JJTwNdOY6j5VRqxIK0lf00bp1faCFT'
                );
            var elements = stripe.elements();

            // Create an instance of the card Element
            var card = elements.create('card', {
                style: {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                }
            });

            // Add an instance of the card Element into the `card-element` div
            card.mount('#card-element');

            // Handle form submission
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                document.getElementById('submit').disabled = true; // Disable button to prevent multiple clicks

                // Create a payment method and handle errors
                stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                }).then(function(result) {
                    if (result.error) {
                        // Show error in the card-errors div
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        document.getElementById('submit').disabled = false; // Re-enable the button
                    } else {
                        // Send the payment method ID to the server
                        stripeTokenHandler(result.paymentMethod.id);
                    }
                });
            });

            function stripeTokenHandler(paymentMethodId) {
                // Add the paymentMethodId to the form as a hidden input
                var form = document.getElementById('payment-form');
                if (!form) {
                    console.error("Form not found");
                    return; // Exit if the form is not found
                }

                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method_id');
                hiddenInput.setAttribute('value', paymentMethodId);
                form.appendChild(hiddenInput);

                // Debugging log
                console.log('Form data prepared, submitting...');

                // Ensure native form submission
                HTMLFormElement.prototype.submit.call(form);

           
            }
        </script>

    </div>
@endsection

@section('css')
    <style>
        /* Basic styling */
        .checkout-title {
            text-align: center;
            font-size: 2rem;
            margin-top: 20px;
            color: #333;
        }

        .checkout-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.5rem;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .btn-pay-now {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-pay-now:hover {
            background-color: #45a049;
        }
    </style>
@endsection
