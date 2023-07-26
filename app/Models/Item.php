<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stok', 'price'];

    public function transactionItems(){
        return $this->hasMany(TransactionItem::class)->onDelete('cascade');
    }
}
