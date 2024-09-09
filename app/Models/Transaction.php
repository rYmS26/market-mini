<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'transactions';

    // The attributes that are mass assignable.
    protected $fillable = [
        'product_name',
        'amount',
        'status',
    ];

    // Optionally, you can define any relationships here
    // For example, if a transaction belongs to a user:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
