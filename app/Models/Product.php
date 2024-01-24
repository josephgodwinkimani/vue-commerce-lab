<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Adjust the inventory count when a product is sold.
     */
    public function adjustInventoryOnSale(int $quantitySold): void
    {
        // Subtract the quantity sold from the current inventory.
        $this->quantity -= $quantitySold;

        // Update the product.
        $this->save();
    }
}
