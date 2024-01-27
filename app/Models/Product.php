<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'image',
        'name',
        'price',
        'quantity',
        'sku',
    ];

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['lifetime_sales', 'lifetime_revenue'];

    /**
     * Order relationship.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }

    /**
     * Order item relationship.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Adjust the inventory count when a product is sold.
     */
    public function adjustInventoryOnSale(int $quantitySold): void
    {
        $this->quantity -= $quantitySold;
        $this->save();
    }

    /**
     * Calculate total lifetime sales of a product.
     */
    public function getLifetimeSalesAttribute(): int
    {
        return $this->orderItems()->sum('quantity');
    }

    /**
     * Calculate total lifetime revenue of a product.
     */
    public function getLifetimeRevenueAttribute(): int
    {
        return $this->orderItems()
            ->with('product')
            ->get()
            ->sum(function ($orderItem) {
                return $orderItem->quantity * $orderItem->product->price;
            });
    }

    /**
     * Calculate total sales of the product in a specific period.
     */
    public function totalSalesInPeriod(int $days = 7): int
    {
        return $this->orderItems()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.created_at', '>=', Carbon::now()->subDays($days))
            ->sum('order_items.quantity');
    }

    /**
     * Get top selling products in the last $days.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeBestSellingProducts($query, int $days = 7, int $limit = 3): Builder
    {
        return $query->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->where('order_items.created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('products.id')
            ->selectRaw('products.*, sum(order_items.quantity) as total_quantity_sold')
            ->orderByDesc('total_quantity_sold')
            ->limit($limit);
    }
}
