<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all orders with filters
     */
    public function index(Request $request)
    {
        $query = Order::query();

        // Filter by order type
        if ($request->filled('order_type')) {
            $query->where('order_type', $request->order_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by customer name (search)
        if ($request->filled('customer_name')) {
            $query->where('name', 'like', '%' . $request->customer_name . '%');
        }

        // Filter by email (search)
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        // Stats (always show total counts, not filtered)
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'full_orders' => Order::where('order_type', 'full')->count(),
            'deposit_orders' => Order::where('order_type', 'deposit')->count(),
        ];
        
        return view('admin.orders', compact('orders', 'stats'));
    }

    /**
     * Show a specific order
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order-detail', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Delete an order
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
    }
}
