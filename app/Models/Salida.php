<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = 'salida';

    protected $primaryKey = 'id_salida';

    protected $fillable = [
        'id_mat_alm',
        'cantidad',
    ];

    public $timestamps = ['created_at'];

    protected $dates = ['created_at'];

    // Relación con la tabla MaterialAlmacen
    public function materialAlmacen()
    {
        return $this->belongsTo(MaterialAlmacen::class, 'id_mat_alm');
    }
}