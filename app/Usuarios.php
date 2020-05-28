<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = array('id_usuario','nombre','apellido','usuario','clave','activo','id_tipousuario');
}
