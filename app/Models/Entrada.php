<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entrada';
    protected $primaryKey = 'id_entrada';
    public $timestamps = true;

    protected $fillable = [
        'id_mat_alm',
        'cantidad',
        'valor',
    ];

    public function materialAlmacen()
    {
        return $this->belongsTo(MaterialAlmacen::class, 'id_mat_alm');
    }

}