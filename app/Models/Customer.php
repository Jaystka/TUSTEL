<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'id_customer',
        'nama',
        'alamat',
        'no_telp',
    ];
    public $incrementing = false;
}
