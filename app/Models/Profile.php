<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['bio', 'address', 'avatar', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
