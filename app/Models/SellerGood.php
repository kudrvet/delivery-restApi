<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerGood extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id','description','price'];

    function good()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Seller');

    }

}
