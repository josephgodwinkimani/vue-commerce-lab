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
     * Get the orders for the customer.
     *
     * @returns \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the top customers by total amount spent.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function topCustomers(int $days = 7, int $limit = 3)
    {
        return self::join('orders', 'customers.id', '=', 'orders.customer_id')
            ->where('orders.created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('customers.id')
            ->selectRaw('customers.*, sum(orders.total_amount) as total_spent')
            ->orderByDesc('total_spent')
            ->take($limit)
            ->get();
    }
}
