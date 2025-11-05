<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Show order now page with dynamic settings
     */
    public function index()
    {
        $settings = [
            'product_price' => Setting::getValue('product_price', 3500),
            'tax_rate' => Setting::getValue('tax_rate', 8),
            'shipping_cost' => Setting::getValue('shipping_cost', 200),
            'deposit_percentage' => Setting::getValue('deposit_percentage', 30),
        ];

        return view('ordernow', compact('settings'));
    }

    /**
     * Store order data before Stripe checkout
     */
    public function store(Request $request)
    {
        // Ensure we always return JSON
        $request->headers->set('Accept', 'application/json');
        
        try {
            $validated = $request->validate([
                'order_type' => 'required|in:full,deposit',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:255',
                'billing_address_line1' => 'required|string|max:255',
                'billing_address_unit' => 'nullable|string|max:255',
                'billing_city' => 'required|string|max:255',
                'billing_state' => 'required|string|max:255',
                'billing_zip' => 'required|string|max:255',
                'shipping_name' => 'nullable|string|max:255',
                'shipping_address_line1' => 'nullable|string|max:255',
                'shipping_address_unit' => 'nullable|string|max:255',
                'shipping_city' => 'nullable|string|max:255',
                'shipping_state' => 'nullable|string|max:255',
                'shipping_zip' => 'nullable|string|max:255',
                'quantity' => 'required|integer|min:1|max:10',
                'comments' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed. Please check your input.',
                'errors' => $e->errors(),
            ], 422);
        }

        // Get current settings
        $unitPrice = Setting::getValue('product_price', 3500);
        $taxRate = Setting::getValue('tax_rate', 8);
        $shippingCost = Setting::getValue('shipping_cost', 200);
        $depositPercentage = Setting::getValue('deposit_percentage', 30);

        // Calculate prices
        $quantity = (int) $request->quantity;
        $subtotal = $unitPrice * $quantity;
        
        if ($request->order_type === 'deposit') {
            $depositPercentageDecimal = $depositPercentage / 100;
            $subtotal = $subtotal * $depositPercentageDecimal;
            $depositAmount = $subtotal;
        } else {
            $depositAmount = null;
        }

        $taxAmount = $subtotal * ($taxRate / 100);
        $totalAmount = $subtotal + $taxAmount + $shippingCost;

        try {
            // Convert empty strings to null for nullable fields
            $shippingName = !empty($request->shipping_name) ? $request->shipping_name : null;
            $shippingAddressLine1 = !empty($request->shipping_address_line1) ? $request->shipping_address_line1 : null;
            $shippingAddressUnit = !empty($request->shipping_address_unit) ? $request->shipping_address_unit : null;
            $shippingCity = !empty($request->shipping_city) ? $request->shipping_city : null;
            $shippingState = !empty($request->shipping_state) ? $request->shipping_state : null;
            $shippingZip = !empty($request->shipping_zip) ? $request->shipping_zip : null;
            $phone = !empty($request->phone) ? $request->phone : null;
            $billingAddressUnit = !empty($request->billing_address_unit) ? $request->billing_address_unit : null;
            $comments = !empty($request->comments) ? $request->comments : null;

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'order_type' => $request->order_type,
                'status' => 'pending',
                'name' => trim($request->name),
                'email' => trim($request->email),
                'phone' => $phone ? trim($phone) : null,
                'billing_address_line1' => trim($request->billing_address_line1),
                'billing_address_unit' => $billingAddressUnit ? trim($billingAddressUnit) : null,
                'billing_city' => trim($request->billing_city),
                'billing_state' => trim($request->billing_state),
                'billing_zip' => trim($request->billing_zip),
                'shipping_name' => $shippingName ? trim($shippingName) : null,
                'shipping_address_line1' => $shippingAddressLine1 ? trim($shippingAddressLine1) : null,
                'shipping_address_unit' => $shippingAddressUnit ? trim($shippingAddressUnit) : null,
                'shipping_city' => $shippingCity ? trim($shippingCity) : null,
                'shipping_state' => $shippingState ? trim($shippingState) : null,
                'shipping_zip' => $shippingZip ? trim($shippingZip) : null,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'tax_rate' => $taxRate,
                'tax_amount' => $taxAmount,
                'shipping_cost' => $shippingCost,
                'total_amount' => $totalAmount,
                'deposit_amount' => $depositAmount,
                'comments' => $comments ? trim($comments) : null,
                'payment_completed' => false,
            ]);

            // Return order data for Stripe checkout
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'message' => 'Order created successfully. Proceeding to payment...',
            ]);
        } catch (\Exception $e) {
            \Log::error('Order creation failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'An error occurred while processing your order.',
            ], 500);
        }
    }

    /**
     * Create Stripe checkout session
     */
    public function createStripeSession(Request $request)
    {
        $request->validate([
            'priceId' => 'required|string',
            'quantity' => 'required|integer|min:1|max:10',
            'email' => 'required|email',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        try {
            // You'll need to install Stripe PHP SDK: composer require stripe/stripe-php
            // For now, return a placeholder response
            // TODO: Implement actual Stripe session creation
            
            return response()->json([
                'success' => false,
                'error' => 'Stripe integration not yet configured. Please contact support.',
            ], 500);
            
            /* 
            // Example Stripe session creation (uncomment when Stripe is configured):
            
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $request->priceId,
                    'quantity' => $request->quantity,
                ]],
                'mode' => 'payment',
                'success_url' => route('order.payment.success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $request->order_id,
                'cancel_url' => route('ordernow') . '?canceled=true',
                'customer_email' => $request->email,
            ]);
            
            return response()->json([
                'success' => true,
                'sessionId' => $session->id,
            ]);
            */
        } catch (\Exception $e) {
            \Log::error('Stripe session creation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to create payment session. Please try again.',
            ], 500);
        }
    }

    /**
     * Handle Stripe payment success callback
     */
    public function paymentSuccess(Request $request)
    {
        $orderId = $request->input('order_id');
        $sessionId = $request->input('session_id');

        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                $order->update([
                    'stripe_session_id' => $sessionId,
                    'payment_completed' => true,
                    'status' => 'processing',
                ]);
            }
        }

        return redirect()->route('ordernow')->with('success', 'Payment successful! Your order has been placed.');
    }
}
