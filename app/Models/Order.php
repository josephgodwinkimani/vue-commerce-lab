<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'billing_address',
        'credit_card_last_four',
        'credit_card_type',
        'customer_id',
        'customer_note',
        'shipping_address',
        'status',
    ];

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['quantity', 'total_revenue'];

    /**
     * Get the related order items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the customer that belongs to the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the total quanity of items in the order.
     */
    public function getQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    /**
     * Get the total revenue of the order.
     */
    public function getTotalRevenueAttribute(): float
    {
        return $this->items->map(function ($item) {
            return $item->quantity * $item->product->price;
        })->sum();
    }

    /**
     * Scope a query to calculate the total dollar amount of recent orders in the last $days.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSumRecentOrdersAmount($query, int $days = 7): float
    {
        return $query->with(['items.product'])
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->get()
            ->sum(function ($order) {
                return $order->items->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });
            });
    }

    /**
     * Scope a query to count the number of orders in the last $days.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeCountRecentOrders($query, int $days = 7): int
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days))->count();
    }
}
