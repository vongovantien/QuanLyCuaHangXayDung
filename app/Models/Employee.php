<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'birthday',
        'address',
        'phone',
        'description',
        'active'
    ];
    public function order_input()
    {
        return $this->hasMany(OrderInput::class);
    }
}
