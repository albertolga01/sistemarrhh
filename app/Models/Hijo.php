<?php 
namespace App\Models;

use CodeIgniter\Model;

class Hijo extends Model{
    protected $table = 'hijos';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['nombreHijo','fechaNacimiento','idEmpleado'];  
}