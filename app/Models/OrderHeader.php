<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory;

    public function order()
    {
        return belongsTo(Order::class);
    }

    public function product()
    {
        return belongsTo(Product::class);
    }
}
