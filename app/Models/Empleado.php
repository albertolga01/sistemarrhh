<?php 
namespace App\Models;

use CodeIgniter\Model;

class Empleado extends Model{
    protected $table = 'empleados';
       // Uncomment below if you want add primary key
       protected $primaryKey = 'id';
       protected $allowedFields =['nombre','domicilio','fechaNacimiento','escolaridad','curp','rfc',
                                    'tipoSangre','puesto','area','tipoPerfil','celular','telefono','salario',
                                    'fechaIngreso','tallaCamisa','tallaPantalon','tallaBotas','foto','nombreEmergencia',
                                    'celularEmergencia','telefonoEmergencia','activo','observaciones','fechaBaja',
                                    'numeroSeguro','estadoCivil','infonavitEmpleado','montoDescuento','fonacotEmpleado','numeroCredito',
                                    'CuentaBancaria','Banco','numeroCuenta','claveInterbancaria'];  
}