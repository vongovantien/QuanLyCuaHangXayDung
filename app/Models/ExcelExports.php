<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelExports extends Model
{
    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
    ];
}
