<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = ['total_price','invoice_number','id_user'];
    protected $primaryKey = 'id';

    public function users(){
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function producOut(){
        return $this->hasMany(ProductOut::class,'id_transaction','id');
    }
}
