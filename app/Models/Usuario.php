<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Usuario extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'email', 'password',
    ];

    // Implementación de los métodos requeridos por la interfaz Authenticatable

    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}
