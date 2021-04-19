<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sales extends Authenticatable
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'sales_name',
        'sales_email',
        'password',
        'sales_phone',
        'sales_address',
    ];
}
