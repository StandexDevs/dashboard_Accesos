<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserExternalModel extends Model
{
    protected $DBGroup = 'externalDB'; // Usar la base de datos externa
    protected $table = 'datos_participante';  // Nombre de la tabla de usuarios en la otra BD
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user_id', 'nombre', 'apellido_paterno', 'apellido_materno', 'institucion_1']; // Ajusta los campos según la BD
}
