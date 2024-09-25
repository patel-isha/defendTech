<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8080';

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => 'price_1Q33oWRvvNNMXfXiHvCxH9vF',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/my-courses.html',
    'cancel_url' => $YOUR_DOMAIN . '/checkout-error.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
