<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialAlmacen extends Model
{
    protected $table = 'material_almacen';
    protected $primaryKey = 'id_mat_alm';
    public $timestamps = true;

    protected $fillable = [
        'id_material', 'id_almacen',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'id_almacen');
    }
        public function almacenes()
    {
        return $this->belongsToMany(Almacen::class, 'material_almacen', 'id_material', 'id_almacen');
    }
}