<?php 
namespace App\Models;

use CodeIgniter\Model;

class Candidato extends Model{
    protected $table = 'candidatos';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'idCandidato';
       protected $allowedFields =['nombreCandidato','fechaEntrevista','psicometrico','referencias','comentarios','puesto','telefono','correo'];  
}