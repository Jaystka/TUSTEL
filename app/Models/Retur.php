<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'id_customer',
        'id_rental',
        'tanggal_kembali',
        'denda'
    ];
}
