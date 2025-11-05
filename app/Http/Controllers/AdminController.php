<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $settings = [
            'product_price' => Setting::getValue('product_price', 3500),
            'tax_rate' => Setting::getValue('tax_rate', 8),
            'shipping_cost' => Setting::getValue('shipping_cost', 200),
            'deposit_percentage' => Setting::getValue('deposit_percentage', 30),
        ];

        $recentContacts = Contact::orderBy('created_at', 'desc')->take(5)->get();
        $unreadContacts = Contact::where('read', false)->count();
        $totalContacts = Contact::count();

        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $fullOrders = Order::where('order_type', 'full')->count();
        $depositOrders = Order::where('order_type', 'deposit')->count();

        return view('admin.dashboard', compact('settings', 'recentContacts', 'unreadContacts', 'totalContacts', 'recentOrders', 'totalOrders', 'pendingOrders', 'processingOrders', 'fullOrders', 'depositOrders'));
    }

    /**
     * Get settings for API (for ordernow page)
     */
    public function getSettings()
    {
        return response()->json([
            'product_price' => Setting::getValue('product_price', 3500),
            'tax_rate' => Setting::getValue('tax_rate', 8),
            'shipping_cost' => Setting::getValue('shipping_cost', 200),
            'deposit_percentage' => Setting::getValue('deposit_percentage', 30),
        ]);
    }
}
