<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address',
        'city',
        'email',
        'name',
        'phone',
        'state',
        'zip',
    ];

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['lifetime_orders', 'lifetime_revenue'];

    /**
     * Get the orders for the customer.
     *
     * @returns \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the total lifetime orders for the customer.
     */
    public function getLifetimeOrdersAttribute(): int
    {
        return (int) $this->orders->count();
    }

    /**
     * Get the total lifetime revenue by the customer.
     */
    public function getLifetimeRevenueAttribute(): int
    {
        return (int) $this->orders->pluck('total')->sum();
    }

    /**
     * Scope a query to get the top customers by total amount spent in the last $days.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBestCustomers($query, int $days = 7, int $limit = 3)
    {
        return $query->with([
            'orders' => function ($query) use ($days) {
                $query->where('created_at', '>=', Carbon::now()->subDays($days))
                    ->with('items.product');
            },
        ])
            ->get()
            ->map(function ($customer) {
                // Calculate total spent for each customer.
                $customer->total_spent = $customer->orders->sum(function ($order) {
                    return $order->items->sum(function ($item) {
                        return $item->quantity * $item->product->price;
                    });
                });

                return $customer;
            })
            ->sortByDesc('total_spent')
            ->take($limit);
    }
}
