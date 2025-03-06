<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosModel extends Model
{
    protected $table            = 'eventos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'id_user', 'nombre_evento', 'id_cliente', 'email_cliente', 'fecha_inicio',
        'fecha_fin', 'recinto', 'recinto_ub', 'status_evento', 'created_at'
    ];

    protected $useTimestamps = false; // La tabla usa CURRENT_TIMESTAMP, no timestamps de CodeIgniter
    protected $dateFormat    = 'datetime';
    
}
