<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOut extends Model
{
    use HasFactory;
    protected $table = 'product_outs';
    protected $fillable = ['total_items','id_product','id_transaction'];
    protected $primaryKey = 'id_product_out';

    public function transaction(){
        return $this->belongsTo(Transaction::class,'id_transactions','id_transaction');
    }
    public function product():HasOne
    {
        return $this->hasOne(Product::class,'product_id','id_product');
    }
}
