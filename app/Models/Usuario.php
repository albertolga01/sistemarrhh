<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model{
    protected $table      = 'usuarios';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields =['username','email','password','tipo'];    

    public function buscarUsuarioPorEmail($emailUsuario){
        $db = db_connect();
        $builder= $db->table($this->table)->where('email',$emailUsuario);
        $resultado =  $builder->get();
        return $resultado->getResult() ? $resultado->getResult()[0] : false;
    }
}