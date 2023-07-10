<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_retur';
    protected $fillable = [
        'id_retur',
        'id_rental',
        'tanggal_kembali',
        'denda'
    ];
    public $incrementing = false;
}
