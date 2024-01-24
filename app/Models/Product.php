<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Get the order items for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Adjust the inventory count when a product is sold.
     */
    public function adjustInventoryOnSale(int $quantitySold): void
    {
        // Subtract the quantity sold from the current inventory.
        $this->quantity -= $quantitySold;

        // Update the product.
        $this->save();
    }

    /**
     * Get top selling products in the last $days.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function topSellingProducts(int $days = 7, int $limit = 3)
    {
        return self::where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('id')
            ->selectRaw('products.*, sum(quantity) as total_quantity_sold')
            ->orderByDesc('total_quantity_sold')
            ->limit($limit)
            ->get();
    }

    /**
     * Calculate total sales of the product in a specific period.
     */
    public function totalSalesInPeriod(int $days = 7): int
    {
        return $this->orders()
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->sum('quantity');
    }

    /**
     * Calculate total lifetime sales of the product.
     */
    public function totalLifetimeSales(): int
    {
        return $this->orders()->sum('quantity');
    }
}
