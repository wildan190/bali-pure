<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';
  protected $fillable = [
    'order_number',
    'product_id',
    'quantity',
    'total',
    'name',
    'phone',
    'address',
    'status',
    'address_detail',
    'postal_code',
  ];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
