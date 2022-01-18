<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInput extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'employee_id',
    ];
    public function order_deltal_input()
    {
        return $this->hasMany(OrderDetailInput::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
