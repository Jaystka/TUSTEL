<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rental';
    protected $fillable = [
        'id_rental',
        'id_customer',
        'id_produk',
        'tanggal_sewa',
        'jumlah',
        'durasi',
        'status'
    ];
    public $incrementing = false;
}
