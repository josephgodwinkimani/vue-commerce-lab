<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'total_amount',
    ];

    /**
     * Order item relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the customer that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the product that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the total dollar amount of recent orders in the last $days.
     */
    public static function sumRecentOrdersAmount(int $days = 7): int
    {
        return (int) self::where('created_at', '>=', Carbon::now()->subDays($days))
            ->sum('total_amount');
    }

    /**
     * Count the number of orders in the last $days.
     */
    public static function countRecentOrders(int $days = 7): int
    {
        return self::where('created_at', '>=', Carbon::now()->subDays($days))->count();
    }
}
