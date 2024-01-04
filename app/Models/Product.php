<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable=['name','price','stock','url_img','id_user'];
    protected $primaryKey='id';

    public function users(){
        return $this->belongsTo(User::class,'id_user','id');
    }


}
