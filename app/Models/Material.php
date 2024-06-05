<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';
    protected $primaryKey = 'id_material';
    public $timestamps = true;

    protected $fillable = [
        'id_medida', 'nombrema', 'cantidad', 'cantidad_seguridad'
    ];

    public function medida()
    {
        return $this->belongsTo(Medida::class, 'id_medida');
    }
    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'material_almacen', 'id_almacen', 'id_material');
    }
}

