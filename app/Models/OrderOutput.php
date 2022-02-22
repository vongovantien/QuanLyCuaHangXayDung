<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOutput extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'employee_id',
    ];
    public function order_deltal_output()
    {
        return $this->hasMany(OrderDetailInput::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
