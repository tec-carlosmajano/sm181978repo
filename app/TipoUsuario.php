<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipousuario';
    protected $primaryKey = 'id_tipousuario';
    protected $fillable = array('nombre_tipo');
}
