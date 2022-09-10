<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable=['gateway','res_id','ref_code','status','order_id'];

    use HasFactory;
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
