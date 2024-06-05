<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
    protected $primaryKey = 'id_almacen';
    public $timestamps = true;

    protected $fillable = [
        'id_ubicacion', 'nombrea'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'material_almacen', 'id_almacen', 'id_material');
    }
}