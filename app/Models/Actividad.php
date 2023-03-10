<?php 
namespace App\Models;

use CodeIgniter\Model;

class Actividad extends Model{
    protected $table = 'actividades';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'idActividades';
       protected $allowedFields =['idUsuario','cambio','fechaCambio'];  
}