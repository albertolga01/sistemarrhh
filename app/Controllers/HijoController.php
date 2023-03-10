<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Hijo;
use App\Models\Empleado;
use App\Models\Actividad;


use CodeIgniter\I18n\Time;


class HijoController extends Controller{

    public function index(){            
        $hijo = new Hijo();       
        $empleado = new Empleado();                 
        $data['pageTitle']= 'Hijos';
        $data['empleados'] = $empleado->select('id,nombre')->where('activo',1)->findAll();     
        $data['hijos'] = $hijo->select('hijos.id,hijos.nombreHijo,hijos.fechaNacimiento,hijos.idEmpleado,empleados.nombre')->join('empleados', 'empleados.id = hijos.idEmpleado')->findAll();  
        return view('hijos/hijos',$data);        
    }


    public function guardarHijo(){
        $hijo = new Hijo();    
              
        $idEmpleado = $this->request->getVar('idEmpleado') ;
        $datos=[  
            'nombreHijo'=> $this->request->getVar('nombreHijo'),
            'fechaNacimiento' => $this->request->getVar('fechaNacimiento'),
            'idEmpleado' => $this->request->getVar('idEmpleado')            
        ];
        $hijo->insert($datos);  

        $actividad = new Actividad();   
        $empleado = new Empleado();   
        $datosEmpleado = $empleado->where('id',$idEmpleado)->first(); 
        $cambio = "Se agregó el hijo del empleado " . $datosEmpleado['nombre'];        
        $hoy = new Time();
        $datosActividad=[
            'idUsuario' => $this->request->getVar('Username'),
            'cambio' => $cambio,
            'fechaCambio' => $hoy
        ];
        $actividad->insert($datosActividad); 
        return $this->response->redirect(base_url('/hijos'));
    }


}
?>
