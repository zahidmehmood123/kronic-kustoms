<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Show settings page
     */
    public function index()
    {
        $settings = [
            'product_price' => Setting::getValue('product_price', 3500),
            'tax_rate' => Setting::getValue('tax_rate', 8),
            'shipping_cost' => Setting::getValue('shipping_cost', 200),
            'deposit_percentage' => Setting::getValue('deposit_percentage', 30),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_price' => 'required|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'shipping_cost' => 'required|numeric|min:0',
            'deposit_percentage' => 'required|numeric|min:0|max:100',
        ]);

        Setting::setValue('product_price', $request->product_price, 'number', 'Product base price');
        Setting::setValue('tax_rate', $request->tax_rate, 'number', 'Tax rate percentage');
        Setting::setValue('shipping_cost', $request->shipping_cost, 'number', 'Shipping cost');
        Setting::setValue('deposit_percentage', $request->deposit_percentage, 'number', 'Deposit percentage for pre-orders');

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }
}
