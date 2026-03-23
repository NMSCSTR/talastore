<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false; 

    protected $fillable = ['order_id', 'product_id', 'supplier_id', 'quantity', 'price'];


    public function product()
    {
        // withTrashed allows the order to still link to a deleted product
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
