<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable=['name','price','stock','url_img','user_id'];
    protected $primaryKey='product_id';

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }


}
