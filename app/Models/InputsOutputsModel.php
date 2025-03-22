<?php

namespace App\Models;

use CodeIgniter\Model;

class InputsOutputsModel extends Model{
    // Nombre de la tabla en la base de datos
    protected $table = 'inputs_outputs';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // Campos que se pueden insertar o actualizar
    protected $allowedFields = [
        'day',
        'month',
        'year',
        'hour',
        'idUser',
        'type',
        'userRegistration',
        'nombreCompleto',
        'empresa',
        'id_evento'
    ];

    // Si deseas que CodeIgniter maneje automáticamente las fechas de creación y actualización
    protected $useTimestamps = false; // Cambia a true si necesitas timestamps

    // Formato de fecha (si usas timestamps)
    protected $dateFormat = 'datetime';

    // Si deseas usar la función de soft delete (eliminación suave)
    protected $useSoftDeletes = false; // Cambia a true si necesitas soft delete

    // Campos para la eliminación suave (si usas soft delete)
    // protected $deletedField = 'deleted_at';

    // Validación de los campos
    protected $validationRules = [
        'day' => 'required|max_length[100]',
        'month' => 'required|max_length[100]',
        'year' => 'required|max_length[100]',
        'hour' => 'required|valid_time', // Valida que sea una hora válida
        'idUser' => 'required|max_length[500]',
        'type' => 'required|max_length[100]',
        'userRegistration' => 'required|max_length[100]',
        'nombreCompleto' => 'required|max_length[200]',
        'empresa' => 'required|max_length[200]',
        'id_evento' => 'permit_empty|integer'
    ];

    // Mensajes de validación personalizados
    protected $validationMessages = [
        'day' => [
            'required' => 'El campo día es obligatorio.',
            'max_length' => 'El campo día no debe exceder los 100 caracteres.'
        ],
        'month' => [
            'required' => 'El campo mes es obligatorio.',
            'max_length' => 'El campo mes no debe exceder los 100 caracteres.'
        ],
        'year' => [
            'required' => 'El campo año es obligatorio.',
            'max_length' => 'El campo año no debe exceder los 100 caracteres.'
        ],
        'hour' => [
            'required' => 'El campo hora es obligatorio.',
            'valid_time' => 'El campo hora debe ser una hora válida.'
        ],
        'idUser' => [
            'required' => 'El campo idUser es obligatorio.',
            'max_length' => 'El campo idUser no debe exceder los 500 caracteres.'
        ],
        'type' => [
            'required' => 'El campo tipo es obligatorio.',
            'max_length' => 'El campo tipo no debe exceder los 100 caracteres.'
        ],
        'userRegistration' => [
            'required' => 'El campo userRegistration es obligatorio.',
            'max_length' => 'El campo userRegistration no debe exceder los 100 caracteres.'
        ],
        'nombreCompleto' => [
            'required' => 'El campo nombreCompleto es obligatorio.',
            'max_length' => 'El campo nombreCompleto no debe exceder los 200 caracteres.'
        ],
        'empresa' => [
            'required' => 'El campo empresa es obligatorio.',
            'max_length' => 'El campo empresa no debe exceder los 200 caracteres.'
        ],
        'id_evento' => [
            'integer' => 'El campo id_evento debe ser un número entero.'
        ]
    ];

    // Si deseas usar la función de devolución de datos como objetos en lugar de arrays
    protected $returnType = 'array'; // Cambia a 'object' si prefieres objetos
}