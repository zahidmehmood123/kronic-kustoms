@extends('admin.layout')

@section('title', 'Order Detail')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <a href="{{ route('admin.orders') }}">📦 All Orders</a>
    <span>/</span>
    <span class="active">Order Details - {{ $order->order_number }}</span>
@endsection

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Order Details - {{ $order->order_number }}</h2>
            <div>
                <a href="{{ route('admin.orders') }}" class="btn-submit" style="display: inline-block; text-decoration: none; background: #555; margin-right: 10px;">← Back to List</a>
                <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this order?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-submit" style="background: #ff4444;">
                        🗑️ Delete Order
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Status -->
        <div style="background: #555; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #FF0000;">Order Status:</strong>
                    <span style="padding: 8px 12px; border-radius: 5px; background: {{ $order->status_color }}; color: white; margin-left: 10px; font-weight: bold;">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" style="display: inline;">
                    @csrf
                    <select name="status" style="padding: 8px; background: #555; color: #EDEDED; border: 1px solid #777; border-radius: 5px; margin-right: 10px;">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn-submit" style="padding: 8px 16px; font-size: 14px;">↻ Update Status</button>
                </form>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Customer Information</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div>
                    <strong style="color: #FF0000;">Name:</strong>
                    <p style="margin-top: 5px;">{{ $order->name }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Email:</strong>
                    <p style="margin-top: 5px;">
                        <a href="mailto:{{ $order->email }}" style="color: #EDEDED; text-decoration: none;">{{ $order->email }}</a>
                    </p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Phone:</strong>
                    <p style="margin-top: 5px;">{{ $order->phone ?: 'Not provided' }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Order Type:</strong>
                    <p style="margin-top: 5px;">
                        <span style="padding: 4px 8px; border-radius: 3px; background: {{ $order->order_type === 'full' ? '#FF0000' : '#FFA500' }}; color: white; font-size: 12px;">
                            {{ $order->order_type_label }}
                        </span>
                    </p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Order Date:</strong>
                    <p style="margin-top: 5px;">{{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <strong style="color: #FF0000;">Payment Status:</strong>
                    <p style="margin-top: 5px;">
                        <span style="padding: 4px 8px; border-radius: 3px; background: {{ $order->payment_completed ? '#00FF00' : '#FF0000' }}; color: white; font-size: 12px;">
                            {{ $order->payment_completed ? 'Paid' : 'Pending' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Billing Address -->
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Billing Address</h3>
            <div style="background: #555; padding: 15px; border-radius: 8px;">
                <p>{{ $order->name }}</p>
                <p>{{ $order->billing_address_line1 }}{{ $order->billing_address_unit ? ', ' . $order->billing_address_unit : '' }}</p>
                <p>{{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_zip }}</p>
            </div>
        </div>

        <!-- Shipping Address -->
        @if($order->shipping_address_line1)
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Shipping Address</h3>
            <div style="background: #555; padding: 15px; border-radius: 8px;">
                <p>{{ $order->shipping_name ?: $order->name }}</p>
                <p>{{ $order->shipping_address_line1 }}{{ $order->shipping_address_unit ? ', ' . $order->shipping_address_unit : '' }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
            </div>
        </div>
        @endif

        <!-- Order Details -->
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Order Details</h3>
            <div style="background: #555; padding: 20px; border-radius: 8px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Quantity:</span>
                    <strong>{{ $order->quantity }} unit(s)</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Unit Price:</span>
                    <strong>${{ number_format($order->unit_price, 2) }}</strong>
                </div>
                @if($order->order_type === 'deposit')
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Deposit Amount:</span>
                    <strong>${{ number_format($order->deposit_amount, 2) }}</strong>
                </div>
                @endif
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Subtotal:</span>
                    <strong>${{ number_format($order->subtotal, 2) }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Tax ({{ $order->tax_rate }}%):</span>
                    <strong>${{ number_format($order->tax_amount, 2) }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Shipping:</span>
                    <strong>${{ number_format($order->shipping_cost, 2) }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 2px solid #777; font-size: 1.2em;">
                    <span style="color: #FF0000; font-weight: bold;">Total:</span>
                    <strong style="color: #FF0000;">${{ number_format($order->total_amount, 2) }}</strong>
                </div>
            </div>
        </div>

        @if($order->comments)
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Customer Comments</h3>
            <div style="background: #555; padding: 15px; border-radius: 8px; white-space: pre-wrap;">{{ $order->comments }}</div>
        </div>
        @endif

        @if($order->stripe_session_id)
        <div class="card">
            <h3 style="color: #FF0000; margin-bottom: 15px;">Payment Information</h3>
            <div style="background: #555; padding: 15px; border-radius: 8px;">
                <p><strong>Stripe Session ID:</strong> {{ $order->stripe_session_id }}</p>
                @if($order->stripe_payment_intent_id)
                <p><strong>Payment Intent ID:</strong> {{ $order->stripe_payment_intent_id }}</p>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection

