<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;

    protected $table = "bills";

    protected $fillable = [
        'userid',
        'rate',
        'kwh',
        'total_bill',
        'due',
        'status',
        'payment_method',
        'paid_on'
    ];

    public function User() {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}
