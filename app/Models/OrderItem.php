<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    /**
     * The "booted" method of the model.
     *
     * Called after the model is initialized. Used here to register model
     * event listeners for 'saved' and 'deleted' events.
     */
    protected static function booted(): void
    {
        parent::booted();

        // Listener for the 'saved' event.
        static::saved(function ($orderItem) {
            Cache::forget("order_{$orderItem->order_id}_total_revenue");
            Cache::forget('sum_recent_orders_amount_7_days');

            if ($product = $orderItem->product) {
                $lifetimeRevenue = $product->getLifetimeRevenueAttribute();
                $lifetimeSales = $product->getLifetimeSalesAttribute();
                Cache::put("product_{$product->id}_lifetime_sales", $lifetimeSales, now()->addHours(24));
                Cache::put("product_{$product->id}_lifetime_revenue", $lifetimeRevenue, now()->addHours(24));
            }
        });

        // Listener for the 'deleted' event.
        static::deleted(function ($orderItem) {
            Cache::forget("order_{$orderItem->order_id}_total_revenue");
            Cache::forget('sum_recent_orders_amount_7_days');

            if ($product = $orderItem->product()->first()) {
                Cache::forget("product_{$product->id}_lifetime_sales");
                Cache::forget("product_{$product->id}_lifetime_revenue");
            }
        });
    }

    /**
     * Get the order that the order item belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that the order item belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
