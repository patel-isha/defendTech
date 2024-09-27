<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
require_once 'secrets.php';
session_start();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    \Stripe\Stripe::setApiKey($stripeSecretKey);
    header('Content-Type: application/json');

    $YOUR_DOMAIN = 'http://localhost:8080';

    $product_data =[];
    $total_cost =0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $product_data[] = [
            'price_data' => [
                'currency' => 'gbp',
                'product_data' => [
                    'name' => $cart_item['course_title'],
                ],
                'unit_amount' => $cart_item['course_cost'] * 100, // amount in cents
            ],
            'quantity' => 1,
        ];
    }

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $product_data,
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/my-courses.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $YOUR_DOMAIN . '/checkout-error.php',
    ]);

    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
}else{
    echo "<script> location.href='login.php'; </script>";
}

