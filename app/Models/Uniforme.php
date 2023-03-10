<?php 
namespace App\Models;

use CodeIgniter\Model;

class Uniforme extends Model{
    protected $table = 'uniformes';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['idEmpleado','nombreEmpleado','camisa','pantalon','botas','fechaEntrega'];  
}