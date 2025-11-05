@extends('admin.layout')

@section('title', 'Orders')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <span class="active">📦 All Orders</span>
@endsection

@section('content')
    <div class="card">
        <h2>Order Management</h2>
        <p style="margin-bottom: 20px;">Manage all customer orders and pre-orders.</p>
    </div>

    <div class="dashboard-grid">
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="value">{{ $stats['total'] }}</div>
            <div class="label">All orders</div>
        </div>
        <div class="stat-card">
            <h3>Pending</h3>
            <div class="value" style="color: #FF0000;">{{ $stats['pending'] }}</div>
            <div class="label">Awaiting payment</div>
        </div>
        <div class="stat-card">
            <h3>Processing</h3>
            <div class="value" style="color: #FFA500;">{{ $stats['processing'] }}</div>
            <div class="label">In progress</div>
        </div>
        <div class="stat-card">
            <h3>Completed</h3>
            <div class="value" style="color: #00FF00;">{{ $stats['completed'] }}</div>
            <div class="label">Finished</div>
        </div>
        <div class="stat-card">
            <h3>Full Orders</h3>
            <div class="value">{{ $stats['full_orders'] }}</div>
            <div class="label">Order Now</div>
        </div>
        <div class="stat-card">
            <h3>Pre-Orders</h3>
            <div class="value">{{ $stats['deposit_orders'] }}</div>
            <div class="label">Reserve Now</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card">
        <h2>Filter Orders</h2>
        <form method="GET" action="{{ route('admin.orders') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
            <div class="form-group">
                <label for="order_type" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Order Type</label>
                <select name="order_type" id="order_type" style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
                    <option value="">All Types</option>
                    <option value="full" {{ request('order_type') === 'full' ? 'selected' : '' }}>Full Order</option>
                    <option value="deposit" {{ request('order_type') === 'deposit' ? 'selected' : '' }}>Pre-Order (Deposit)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Status</label>
                <select name="status" id="status" style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="customer_name" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ request('customer_name') }}" placeholder="Search by name..." style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
            </div>

            <div class="form-group">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Email</label>
                <input type="text" name="email" id="email" value="{{ request('email') }}" placeholder="Search by email..." style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
            </div>

            <div class="form-group">
                <label for="date_from" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Date From</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
            </div>

            <div class="form-group">
                <label for="date_to" style="display: block; margin-bottom: 5px; font-weight: bold; color: #EDEDED;">Date To</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" style="width: 100%; padding: 8px; background: #555; border: 1px solid #777; border-radius: 5px; color: #EDEDED;">
            </div>

            <div class="form-group" style="display: flex; align-items: flex-end; gap: 10px;">
                <button type="submit" class="btn-submit" style="padding: 8px 20px; font-size: 14px;">Apply Filters</button>
                <a href="{{ route('admin.orders') }}" class="btn-submit" style="display: inline-block; text-decoration: none; padding: 8px 20px; font-size: 14px; background: #555; text-align: center;">Clear Filters</a>
            </div>
        </form>

        @if(request()->anyFilled(['order_type', 'status', 'customer_name', 'email', 'date_from', 'date_to']))
            <div style="background: #555; padding: 10px; border-radius: 5px; margin-top: 10px;">
                <strong style="color: #FF0000;">Active Filters:</strong>
                <span style="color: #EDEDED; font-size: 0.9em;">
                    @if(request('order_type'))
                        Type: {{ request('order_type') === 'full' ? 'Full Order' : 'Pre-Order' }},
                    @endif
                    @if(request('status'))
                        Status: {{ ucfirst(request('status')) }},
                    @endif
                    @if(request('customer_name'))
                        Name: {{ request('customer_name') }},
                    @endif
                    @if(request('email'))
                        Email: {{ request('email') }},
                    @endif
                    @if(request('date_from'))
                        From: {{ request('date_from') }},
                    @endif
                    @if(request('date_to'))
                        To: {{ request('date_to') }}
                    @endif
                </span>
            </div>
        @endif
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h2>Orders List</h2>
            <div style="color: #999; font-size: 0.9em;">
                @if(request()->anyFilled(['order_type', 'status', 'customer_name', 'email', 'date_from', 'date_to']))
                    Showing {{ $orders->total() }} filtered result(s)
                @else
                    Showing {{ $orders->total() }} total order(s)
                @endif
            </div>
        </div>

        @if($orders->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #555; border-bottom: 2px solid #777;">
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Order #</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Customer</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Type</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Quantity</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Total</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Status</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Date</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr style="border-bottom: 1px solid #555;">
                                <td style="padding: 12px;">{{ $order->order_number }}</td>
                                <td style="padding: 12px;">
                                    <div>{{ $order->name }}</div>
                                    <div style="font-size: 0.85em; color: #999;">{{ $order->email }}</div>
                                </td>
                                <td style="padding: 12px;">
                                    <span style="padding: 4px 8px; border-radius: 3px; background: {{ $order->order_type === 'full' ? '#FF0000' : '#FFA500' }}; color: white; font-size: 12px;">
                                        {{ $order->order_type_label }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">{{ $order->quantity }}</td>
                                <td style="padding: 12px;">${{ number_format($order->total_amount, 2) }}</td>
                                <td style="padding: 12px;">
                                    <span style="padding: 4px 8px; border-radius: 3px; background: {{ $order->status_color }}; color: white; font-size: 12px;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">{{ $order->created_at->format('M d, Y') }}</td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #FF0000; text-decoration: none; margin-right: 10px;" title="View Order">👁️ </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $orders->links() }}
        @else
            <p style="text-align: center; color: #999; padding: 40px;">No orders found matching your filters.</p>
            @if(request()->anyFilled(['order_type', 'status', 'customer_name', 'email', 'date_from', 'date_to']))
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('admin.orders') }}" class="btn-submit" style="display: inline-block; text-decoration: none; background: #555;">Clear Filters</a>
                </div>
            @endif
        @endif
    </div>
@endsection
