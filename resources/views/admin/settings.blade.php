@extends('admin.layout')

@section('title', 'Settings')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <span>/</span>
    <span class="active">⚙️ Pricing & Shipping</span>
@endsection

@section('content')
    <div class="card">
        <h2>Pricing & Shipping Settings</h2>
        <p style="margin-bottom: 25px;">Manage your product pricing, tax rates, shipping costs, and deposit percentages.</p>
        
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            <div class="form-group">
                <label for="product_price">Product Base Price ($)</label>
                <input type="number" 
                       id="product_price" 
                       name="product_price" 
                       value="{{ old('product_price', $settings['product_price']) }}" 
                       step="0.01" 
                       min="0" 
                       required>
                <div class="help-text">The base price for one unit of the product.</div>
                @error('product_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tax_rate">Tax Rate (%)</label>
                <input type="number" 
                       id="tax_rate" 
                       name="tax_rate" 
                       value="{{ old('tax_rate', $settings['tax_rate']) }}" 
                       step="0.1" 
                       min="0" 
                       max="100" 
                       required>
                <div class="help-text">Tax rate as a percentage (e.g., 8 for 8%).</div>
                @error('tax_rate')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="shipping_cost">Shipping Cost ($)</label>
                <input type="number" 
                       id="shipping_cost" 
                       name="shipping_cost" 
                       value="{{ old('shipping_cost', $settings['shipping_cost']) }}" 
                       step="0.01" 
                       min="0" 
                       required>
                <div class="help-text">Fixed shipping cost per order.</div>
                @error('shipping_cost')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deposit_percentage">Deposit Percentage (%)</label>
                <input type="number" 
                       id="deposit_percentage" 
                       name="deposit_percentage" 
                       value="{{ old('deposit_percentage', $settings['deposit_percentage']) }}" 
                       step="0.1" 
                       min="0" 
                       max="100" 
                       required>
                <div class="help-text">Percentage of product price required as deposit for pre-orders (e.g., 30 for 30%).</div>
                @error('deposit_percentage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Update Settings</button>
        </form>
    </div>
@endsection

