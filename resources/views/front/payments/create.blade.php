@extends('layouts.front')

@section('title', 'Payment')

@section('content')
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="alert alert-info" id="payment-message"> </div>
                    <form action="" method="post" id="payment-form">
                        @csrf
                        <div id="payment-element"></div>
                        <button id="submit" type="submit" class="btn btn-primary">
                            <span>
                                <span id="button-text">Pay Now</span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // This is your test publishable API key.
        const stripe = Stripe("{{ config('services.stripe.Publishable_key') }}");
        let elements;

        initialize();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
        async function initialize() {
            const {
                clientSecret
            } = await fetch("{{ route('stripe.paymentIntent.create', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                }),
            }).then((r) => r.json()).catch((error) => {
                console.error("Error fetching payment intent:", error);
            });

            elements = stripe.elements({
                clientSecret
            });

            const paymentElementOptions = {
                layout: "vertical",
                paymentMethodTypes: ["card"],
                style: {
                    base: {
                        color: "#32325d",
                        fontFamily: "-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif",
                        fontSmoothing: "antialiased",
                        fontSize: "16px",
                        "::placeholder": {
                            color: "#aab7c4",
                        },
                    },
                    invalid: {
                        color: "#fa755a",
                    },
                },
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "{{ route('stripe.return', $order->id) }}",
                },
            });

            if (error) {
                if (error.type === "card_error" || error.type === "validation_error") {
                    showMessage(error.message);
                } else {
                    showMessage("An unexpected error occurred.");
                }
            }

            setLoading(false);
        }
        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }
    </script>
@endsection
