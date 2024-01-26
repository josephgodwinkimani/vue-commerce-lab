<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    protected $appends = ['order_count', 'total_spent'];

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
     * Get the total number of orders for the customer.
     */
    public function getOrderCountAttribute(): int
    {
        return (int) $this->orders()->count();
    }

    /**
     * Get the total amount spent by the customer.
     */
    public function getTotalSpentAttribute(): int
    {
        return (int) $this->orders()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->sum(DB::raw('order_items.quantity * order_items.price'));
    }

    /**
     * Get the top customers by total amount spent.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function topCustomers(int $days = 7, int $limit = 3)
    {
        return self::join('orders', 'customers.id', '=', 'orders.customer_id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('customers.id')
            ->selectRaw('customers.*, sum(order_items.quantity * order_items.price) as total_spent')
            ->orderByDesc('total_spent')
            ->take($limit)
            ->get();
    }
}
