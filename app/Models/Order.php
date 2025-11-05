<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'order_type',
        'status',
        'name',
        'email',
        'phone',
        'billing_address_line1',
        'billing_address_unit',
        'billing_city',
        'billing_state',
        'billing_zip',
        'shipping_name',
        'shipping_address_line1',
        'shipping_address_unit',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'quantity',
        'unit_price',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'shipping_cost',
        'total_amount',
        'deposit_amount',
        'comments',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'payment_completed',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'payment_completed' => 'boolean',
    ];

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'KK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Get order type label
     */
    public function getOrderTypeLabelAttribute()
    {
        return $this->order_type === 'full' ? 'Full Order' : 'Pre-Order (Deposit)';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => '#FF0000',
            'processing' => '#FFA500',
            'completed' => '#00FF00',
            'cancelled' => '#999999',
            default => '#666666',
        };
    }
}
