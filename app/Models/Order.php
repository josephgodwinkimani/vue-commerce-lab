<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_revenue' => 'float',
    ];

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
     * Get the total quantity of items in the order.
     */
    public function getQuantityAttribute(): int
    {
        return $this->items()->sum('quantity');
    }

    /**
     * Get the total revenue of the order.
     */
    public function getTotalRevenueAttribute(): float
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    /**
     * Calculate the total dollar amount of recent orders in the last specified days.
     */
    public static function calculateSumRecentOrdersAmount(int $days = 7): float
    {
        return self::with(['items.product'])
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->get()
            ->sum(function ($order) {
                return $order->items->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });
            });
    }

    /**
     * Count the number of orders in the last specified days.
     */
    public static function countRecentOrders(int $days = 7): int
    {
        return self::where('created_at', '>=', Carbon::now()->subDays($days))->count();
    }

    /**
     * Scope a query to get the count of orders grouped by status.
     */
    public function scopeCountByStatus(Builder $query): Builder
    {
        return $query->select('status', DB::raw('count(*) as total'))
            ->groupBy('status');
    }
}
