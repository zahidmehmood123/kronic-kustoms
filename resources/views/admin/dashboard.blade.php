@extends('admin.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <span class="active">Overview</span>
@endsection

@section('content')
   

    <div class="dashboard-grid">
        <div class="stat-card" style="background: linear-gradient(135deg, #555 0%, #4a4a4a 100%); border-left: 4px solid #00FF00; position: relative;">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">💰</div>
            <h3 style="color: #00FF00;">Product Price</h3>
            <div class="value" style="color: #00FF00;">${{ number_format($settings['product_price'], 2) }}</div>
            <div class="label">Base price per unit</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #555 0%, #4a4a4a 100%); border-left: 4px solid #00FF00; position: relative;">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">📊</div>
            <h3 style="color: #00FF00;">Tax Rate</h3>
            <div class="value" style="color: #00FF00;">{{ number_format($settings['tax_rate'], 1) }}%</div>
            <div class="label">Tax percentage</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #555 0%, #4a4a4a 100%); border-left: 4px solid #00FF00; position: relative;">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">🚚</div>
            <h3 style="color: #00FF00;">Shipping Cost</h3>
            <div class="value" style="color: #00FF00;">${{ number_format($settings['shipping_cost'], 2) }}</div>
            <div class="label">Shipping fee per order</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #555 0%, #4a4a4a 100%); border-left: 4px solid #00FF00; position: relative;">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">💳</div>
            <h3 style="color: #00FF00;">Deposit Percentage</h3>
            <div class="value" style="color: #00FF00;">{{ number_format($settings['deposit_percentage'], 0) }}%</div>
            <div class="label">Pre-order deposit</div>
        </div>
    </div>

    

    <div class="dashboard-grid">
        <div class="stat-card" style="background: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%); border-left: 4px solid #FF0000; position: relative; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">📦</div>
            <h3 style="color: #FF0000;">Total Orders</h3>
            <div class="value" style="color: #FF0000; font-size: 2.2em;">{{ $totalOrders }}</div>
            <div class="label">All orders</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%); border-left: 4px solid #FF0000; position: relative; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">⏳</div>
            <h3 style="color: #FF0000;">Pending Orders</h3>
            <div class="value" style="color: {{ $pendingOrders > 0 ? '#FF0000' : '#EDEDED' }}; font-size: 2.2em;">{{ $pendingOrders }}</div>
            <div class="label">Awaiting payment</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%); border-left: 4px solid #FF0000; position: relative; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">⚙️</div>
            <h3 style="color: #FF0000;">Processing</h3>
            <div class="value" style="color: {{ $processingOrders > 0 ? '#FFA500' : '#EDEDED' }}; font-size: 2.2em;">{{ $processingOrders }}</div>
            <div class="label">In progress</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%); border-left: 4px solid #FF0000; position: relative; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">✅</div>
            <h3 style="color: #FF0000;">Full Orders</h3>
            <div class="value" style="color: #FF0000; font-size: 2.2em;">{{ $fullOrders }}</div>
            <div class="label">Order Now</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #3a3a3a 0%, #2d2d2d 100%); border-left: 4px solid #FF0000; position: relative; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">🔒</div>
            <h3 style="color: #FF0000;">Pre-Orders</h3>
            <div class="value" style="color: #FF0000; font-size: 2.2em;">{{ $depositOrders }}</div>
            <div class="label">Reserve Now</div>
        </div>
    </div>

   

    <div class="dashboard-grid">
        <div class="stat-card" style="background: linear-gradient(135deg, #2a3a4a 0%, #1e2a36 100%); border-left: 4px solid #00BFFF; position: relative; box-shadow: 0 5px 15px rgba(0, 191, 255, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">📧</div>
            <h3 style="color: #00BFFF;">Total Contacts</h3>
            <div class="value" style="color: #00BFFF; font-size: 2.2em;">{{ $totalContacts }}</div>
            <div class="label">Contact submissions</div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #2a3a4a 0%, #1e2a36 100%); border-left: 4px solid #00BFFF; position: relative; box-shadow: 0 5px 15px rgba(0, 191, 255, 0.2);">
            <div style="position: absolute; top: 10px; right: 10px; font-size: 1.5em;">🔔</div>
            <h3 style="color: #00BFFF;">Unread Contacts</h3>
            <div class="value" style="color: {{ $unreadContacts > 0 ? '#FF0000' : '#00BFFF' }}; font-size: 2.2em;">{{ $unreadContacts }}</div>
            <div class="label">New messages</div>
        </div>
    </div>

    <div class="card" style="border-left: 4px solid #FF0000; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);">
        <h2 style="color: #FF0000; border-bottom: 2px solid #FF0000; padding-bottom: 10px;">Recent Orders</h2>
        @if($recentOrders->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr style="background: #555; border-bottom: 2px solid #777;">
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Order #</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Customer</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Type</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Quantity</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Total</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Status</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Date</th>
                            <th style="padding: 12px; text-align: left; color: #FF0000;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr style="border-bottom: 1px solid #555;">
                                <td style="padding: 12px;">{{ $order->order_number }}</td>
                                <td style="padding: 12px;">{{ $order->name }}</td>
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
                                    <a href="{{ route('admin.orders.show', $order->id) }}" style="color: #FF0000; text-decoration: none;" title="View Order">👁️ View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.orders') }}" class="btn-submit" style="display: inline-block; text-decoration: none;">📦 View All Orders</a>
            </div>
        @else
            <p style="margin-top: 20px; color: #999;">No orders yet.</p>
        @endif
    </div>

    <div class="card" style="border-left: 4px solid #00BFFF; box-shadow: 0 5px 15px rgba(0, 191, 255, 0.3);">
        <h2 style="color: #00BFFF; border-bottom: 2px solid #00BFFF; padding-bottom: 10px;">Recent Contact Submissions</h2>
        @if($recentContacts->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr style="background: #555; border-bottom: 2px solid #00BFFF;">
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Name</th>
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Email</th>
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Subject</th>
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Date</th>
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Status</th>
                            <th style="padding: 12px; text-align: left; color: #00BFFF;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentContacts as $contact)
                            <tr style="border-bottom: 1px solid #555;">
                                <td style="padding: 12px;">{{ $contact->name }}</td>
                                <td style="padding: 12px;">{{ $contact->email }}</td>
                                <td style="padding: 12px;">{{ $contact->subject ?: 'No Subject' }}</td>
                                <td style="padding: 12px;">{{ $contact->created_at->format('M d, Y') }}</td>
                                <td style="padding: 12px;">
                                    <span style="padding: 4px 8px; border-radius: 3px; background: {{ $contact->read ? '#555' : '#FF0000' }}; color: white; font-size: 12px;">
                                        {{ $contact->read ? 'Read' : 'Unread' }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" style="color: #00BFFF; text-decoration: none;" title="View Contact">👁️ View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 20px;">
                <a href="{{ route('admin.contacts') }}" class="btn-submit" style="display: inline-block; text-decoration: none;">📧 View All Contacts</a>
            </div>
        @else
            <p style="margin-top: 20px; color: #999;">No contact submissions yet.</p>
        @endif
    </div>

    
@endsection

