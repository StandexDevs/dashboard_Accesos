<?php

namespace App\Models;

use CodeIgniter\Model;

class RestModel extends Model{
    protected $table = "inputs_outputs";
    protected $primaryKey = "id";
    protected $allowedFields = ['day', 'month', 'year', 'hour', 'idUser', 'type', 'userRegistration', 'nombreCompleto', 'empresa', 'id_evento'];
    
    function getSalidas ()
    {
        return $this->asArray()
        ->where('type', 'Salida')
        ->select('*')
        ->first();
    }
}