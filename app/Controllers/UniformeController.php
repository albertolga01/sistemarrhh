<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Uniforme;
use App\Models\Empleado;
use App\Models\Actividad;

use CodeIgniter\I18n\Time;


class UniformeController extends Controller{

    public function index(){            
        $uniforme = new Uniforme();       
        $empleado = new Empleado();                 
        $data['pageTitle']= 'Uniformes';
        $data['empleados'] = $empleado->select('id,nombre,tallaCamisa,tallaPantalon,tallaBotas')->where('activo',1)->findAll();
        $data['uniformes'] = $uniforme->findAll();
        return view('uniformes/uniformes',$data);        
    }

    public function guardarUniforme(){
        $uniforme = new Uniforme();
        $empleado = new Empleado();   

        $camisa = $this->request->getVar('camisaEmpleado');        
        if($camisa != 1){$camisa = 0;}

        $pantalon = $this->request->getVar('pantalonEmpleado');
        if($pantalon != 1){$pantalon = 0;}

        $botas = $this->request->getVar('botasEmpleado');
        if($botas != 1){$botas = 0;}

        $idEmpleado = $this->request->getVar('idEmpleado');
        $nombreEmpleado = $empleado->select('nombre')->where('id',$idEmpleado)->first(); 

        $datos=[              
            'idEmpleado' => $idEmpleado,
            'nombreEmpleado'=> $nombreEmpleado['nombre'],
            'camisa'=>$camisa,
            'pantalon'=>$pantalon,
            'botas'=>$botas,
            'fechaEntrega' => $this->request->getVar('fechaEntrega') 
        ];

        $uniforme->insert($datos);  

        $actividad = new Actividad();            
        $datosEmpleado = $empleado->where('id',$idEmpleado)->first(); 
        $cambio = "Se entregaron uniformes al empleado " . $datosEmpleado['nombre'];        
        $hoy = new Time();
        $datosActividad=[
            'idUsuario' => $this->request->getVar('Username'),
            'cambio' => $cambio,
            'fechaCambio' => $hoy
        ];
        $actividad->insert($datosActividad); 
        return $this->response->redirect(base_url('/uniformes'));
    }
}
?>
