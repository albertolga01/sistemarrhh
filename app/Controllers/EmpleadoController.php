<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Empleado;
use App\Models\Actividad;

use CodeIgniter\I18n\Time;


class EmpleadoController extends Controller{

    public function index(){            
        $empleado = new Empleado();                    
        $data['pageTitle']= 'Empleados';
        $data['empleados'] = $empleado->where('activo',1)->orderBy('id','ASC')->findAll();
        return view('empleados/empleado',$data);
    }

    public function ViewBajaindex(){            
        $empleado = new Empleado();                    
        $data['pageTitle']= 'Empleados Baja';
        $data['empleados'] = $empleado->where('activo',0)->orderBy('id','ASC')->findAll();
        return view('empleados/empleadoBaja',$data);
    }

    public function insertEmpleado(){      
        $data['pageTitle']= 'Crear Empleados';  
        return view('empleados/crearEmpleado',$data);
    }

    public function guardarEmpleado(){
        $empleado = new Empleado();

        $fotoEmpleado = $this->request->getFile('fotoEmpleado');
        $nuevoNombre= $fotoEmpleado->getRandomName();
        $fotoEmpleado->move(ROOTPATH.'public/uploads', $nuevoNombre); //PARA SUBIR LA FOTO AL SERVIDOR        
        $activo = 1;

        $infonavitEmpleado =$this->request->getVar('infonavitEmpleado');
        if( $infonavitEmpleado != 1){$infonavitEmpleado = 0;}

        $fonacotEmpleado =$this->request->getVar('fonacotEmpleado');
        if($fonacotEmpleado  != 1){$fonacotEmpleado = 0;}

        $CuentaBancaria =$this->request->getVar('CuentaBancaria');
        if($CuentaBancaria  != 1){
            $CuentaBancaria = 0;
            $Banco='';
        }else{
            $Banco = $this->request->getVar('Banco');
        }
        
       
        $datos=[
            'nombre'=> $this->request->getVar('nombreEmpleado'),
            'domicilio'=> $this->request->getVar('domicilioEmpleado'),
            'fechaNacimiento'=> $this->request->getVar('nacimientoEmpleado') ,
            'escolaridad'=> $this->request->getVar('escolaridadEmpleado'),
            'curp'=> $this->request->getVar('curpEmpleado'),
            'rfc'=> $this->request->getVar('rfcEmpleado'),
            'tipoSangre'=> $this->request->getVar('sangreEmpleado'),
            'puesto'=> $this->request->getVar('puestoEmpleado'),
            'area' => $this->request->getVar('areaEmpleado'),
            'tipoPerfil'=> $this->request->getVar('perfilEmpleado'),
            'celular'=> $this->request->getVar('celularEmpleado'),
            'telefono'=> $this->request->getVar('telefonoEmpleado'),
            'salario'=> $this->request->getVar('salarioEmpleado'),
            'fechaIngreso'=> $this->request->getVar('ingresoEmpleado'),
            'tallaCamisa' => $this->request->getVar('camisaEmpleado'),
            'tallaPantalon' => $this->request->getVar('pantalonEmpleado'),
            'tallaBotas' => $this->request->getVar('botasEmpleado'),
            'foto'=> $nuevoNombre,
            'nombreEmergencia' => $this->request->getVar('nombreEmergencia'),
            'celularEmergencia' => $this->request->getVar('celularEmergencia'),
            'telefonoEmergencia' => $this->request->getVar('telefonoEmergencia'),
            'activo'=> $activo,
            'observaciones' => $this->request->getVar('observacionesEmpleado'),
            'numeroSeguro'=> $this->request->getVar('numeroSeguro'),
            'estadoCivil'=> $this->request->getVar('estadoCivil'),
            'infonavitEmpleado'=> $infonavitEmpleado,
            'montoDescuento'=> $this->request->getVar('montoDescuento'),
            'fonacotEmpleado'=> $fonacotEmpleado,
            'numeroCredito'=> $this->request->getVar('numeroCredito'),
            'CuentaBancaria' => $this->request->getVar('CuentaBancaria'),
            'Banco' => $Banco,
            'numeroCuenta'=> $this->request->getVar('numeroCuenta'),
            'claveInterbancaria' => $this->request->getVar('claveInterbancaria')
        ];
       
        $empleado->insert($datos);  
        
        $actividad = new Actividad();   
        $nombreEmpleado = $this->request->getVar('nombreEmpleado');
        $cambio = "Se agregó el empleado " . $nombreEmpleado;        
        $hoy = new Time();
        $datosActividad=[
            'idUsuario' => $this->request->getVar('Username'),
            'cambio' => $cambio,
            'fechaCambio' => $hoy
        ];
        $actividad->insert($datosActividad); 
        return $this->response->redirect(base_url('/empleados'));
    }

    public function editEmpleado($id=null){        
        $empleado = new Empleado();
        $data['pageTitle']= 'Editar Empleados';
        $data['empleado'] = $empleado->where('id',$id)->first();
        return view('empleados/editarEmpleado',$data);
    }

    public function editarEmpleado(){
        $empleado = new Empleado(); 
        $fotoEmpleado = $this->request->getFile('fotoEmpleado');
        $id = $this->request->getVar('id');
        $observaciones = $this->request->getVar('observacionesEmpleado'); 

        $infonavitEmpleado =$this->request->getVar('infonavitEmpleado');
        if( $infonavitEmpleado != 1){
            $infonavitEmpleado = 0;
        }        
        $fonacotEmpleado =$this->request->getVar('fonacotEmpleado');
        if($fonacotEmpleado  != 1){
            $fonacotEmpleado = 0;
        }

        $CuentaBancaria =$this->request->getVar('CuentaBancaria');
        if($CuentaBancaria  != 1){
            $CuentaBancaria = 0;
            $Banco='';
        }else{
            $Banco = $this->request->getVar('Banco');
        }
        if($fotoEmpleado->isValid()){
            //entra cuando se va cambiar la imagen
            $datosEmpleado = $empleado->where('id',$id)->first();  
            $ruta=(ROOTPATH.'public/uploads/'.$datosEmpleado['foto']);                 
            unlink($ruta);

            $fotoEmpleado = $this->request->getFile('fotoEmpleado');
            $nuevoNombre= $fotoEmpleado->getRandomName();
            $fotoEmpleado->move(ROOTPATH.'public/uploads', $nuevoNombre);//PARA SUBIR LA FOTO AL SERVIDOR

            $datos=[
                'nombre'=> $this->request->getVar('nombreEmpleado'),
                'domicilio'=> $this->request->getVar('domicilioEmpleado'),
                'fechaNacimiento'=> $this->request->getVar('nacimientoEmpleado') ,
                'escolaridad'=> $this->request->getVar('escolaridadEmpleado'),
                'curp'=> $this->request->getVar('curpEmpleado'),
                'rfc'=> $this->request->getVar('rfcEmpleado'),
                'tipoSangre'=> $this->request->getVar('sangreEmpleado'),
                'puesto'=> $this->request->getVar('puestoEmpleado'),
                'area' => $this->request->getVar('areaEmpleado'),
                'tipoPerfil'=> $this->request->getVar('perfilEmpleado'),
                'celular'=> $this->request->getVar('celularEmpleado'),
                'telefono'=> $this->request->getVar('telefonoEmpleado'),
                'salario'=> $this->request->getVar('salarioEmpleado'),
                'fechaIngreso'=> $this->request->getVar('ingresoEmpleado'),
                'tallaCamisa' => $this->request->getVar('camisaEmpleado'),
                'tallaPantalon' => $this->request->getVar('pantalonEmpleado'),
                'tallaBotas' => $this->request->getVar('botasEmpleado'),
                'foto'=> $nuevoNombre,
                'nombreEmergencia' => $this->request->getVar('nombreEmergencia'),
                'celularEmergencia' => $this->request->getVar('celularEmergencia'),
                'telefonoEmergencia' => $this->request->getVar('telefonoEmergencia'),
                'observaciones' => $observaciones,
                'numeroSeguro'=> $this->request->getVar('numeroSeguro'),
                'estadoCivil'=> $this->request->getVar('estadoCivil'),
                'infonavitEmpleado'=> $infonavitEmpleado,
                'montoDescuento'=> $this->request->getVar('montoDescuento'),
                'fonacotEmpleado'=> $fonacotEmpleado,
                'numeroCredito'=> $this->request->getVar('numeroCredito'),
                'CuentaBancaria' => $this->request->getVar('CuentaBancaria'),
                'Banco' => $Banco,
                'numeroCuenta'=> $this->request->getVar('numeroCuenta'),
                'claveInterbancaria' => $this->request->getVar('claveInterbancaria')
            ];
            
           $empleado->update($id,$datos);

           $actividad = new Actividad();   
           $nombreEmpleado = $this->request->getVar('nombreEmpleado');
           $cambio = "Se Modificó el empleado " . $nombreEmpleado;        
           $hoy = new Time();
           $datosActividad=[
               'idUsuario' => $this->request->getVar('Username'),
               'cambio' => $cambio,
               'fechaCambio' => $hoy
           ];
           $actividad->insert($datosActividad); 

        }else{
            //entra cuando NO se va cambiar la imagen    
            $datos=[
                'nombre'=> $this->request->getVar('nombreEmpleado'),
                'domicilio'=> $this->request->getVar('domicilioEmpleado'),
                'fechaNacimiento'=> $this->request->getVar('nacimientoEmpleado') ,
                'escolaridad'=> $this->request->getVar('escolaridadEmpleado'),
                'curp'=> $this->request->getVar('curpEmpleado'),
                'rfc'=> $this->request->getVar('rfcEmpleado'),
                'tipoSangre'=> $this->request->getVar('sangreEmpleado'),
                'puesto'=> $this->request->getVar('puestoEmpleado'),
                'area' => $this->request->getVar('areaEmpleado'),
                'tipoPerfil'=> $this->request->getVar('perfilEmpleado'),
                'celular'=> $this->request->getVar('celularEmpleado'),
                'telefono'=> $this->request->getVar('telefonoEmpleado'),
                'salario'=> $this->request->getVar('salarioEmpleado'),
                'fechaIngreso'=> $this->request->getVar('ingresoEmpleado'),
                'tallaCamisa' => $this->request->getVar('camisaEmpleado'),
                'tallaPantalon' => $this->request->getVar('pantalonEmpleado'),
                'tallaBotas' => $this->request->getVar('botasEmpleado'),                
                'nombreEmergencia' => $this->request->getVar('nombreEmergencia'),
                'celularEmergencia' => $this->request->getVar('celularEmergencia'),
                'telefonoEmergencia' => $this->request->getVar('telefonoEmergencia'),   
                'observaciones' => $observaciones,
                'numeroSeguro'=> $this->request->getVar('numeroSeguro'),
                'estadoCivil'=> $this->request->getVar('estadoCivil'),
                'infonavitEmpleado'=> $infonavitEmpleado,
                'montoDescuento'=> $this->request->getVar('montoDescuento'),
                'fonacotEmpleado'=> $fonacotEmpleado,
                'numeroCredito'=> $this->request->getVar('numeroCredito'),
                'CuentaBancaria' => $this->request->getVar('CuentaBancaria'),
                'Banco' => $Banco,
                'numeroCuenta'=> $this->request->getVar('numeroCuenta'),
                'claveInterbancaria' => $this->request->getVar('claveInterbancaria')  
            ];        
                      
            $empleado->update($id,$datos);
            $actividad = new Actividad();   
            $nombreEmpleado = $this->request->getVar('nombreEmpleado');
            $cambio = "Se Modificó el empleado " . $nombreEmpleado;        
            $hoy = new Time();
            $datosActividad=[
                'idUsuario' => $this->request->getVar('Username'),
                'cambio' => $cambio,
                'fechaCambio' => $hoy
            ];
            $actividad->insert($datosActividad); 
        }
                              
       return $this->response->redirect(base_url('/empleados'));
                
    }

    public function deleteEmpleado($id=null,$username=null){        
        $empleado = new Empleado();  
        $activo= 0;      
        $hoy = new Time();
        $data=[
            'activo'=> $activo,
            'fechaBaja' => $hoy                     
        ];        
        $empleado->update($id,$data);

        $datosEmpleado = $empleado->where('id',$id)->first(); 
        $actividad = new Actividad();   
        $nombreEmpleado = $this->request->getVar('nombreEmpleado');
        $cambio = "Se dio de Baja el empleado " . $datosEmpleado['nombre'];                
        $datosActividad=[
            'idUsuario' => $username,
            'cambio' => $cambio,
            'fechaCambio' => $hoy
        ];
        $actividad->insert($datosActividad); 

        return $this->response->redirect(base_url('/empleados'));
    }

    public function altaEmpleado($id=null){
        $empleado = new Empleado();  
        $activo= 1;  
        $fechaBaja="";    
        $data=[
            'activo'=> $activo ,
            'fechaBaja' => $fechaBaja                    
        ];        
        $empleado->update($id,$data);
        return $this->response->redirect(base_url('/empleados'));
    }

    public function cartaEmpleado($id=null){
        $empleado = new Empleado();
        $data['pageTitle']= 'Carta Empleado';
        $data['empleado'] = $empleado->where('id',$id)->first();
        return view('empleados/cartaEmpleado',$data);
    }

    public function checkListEmpleado($id=null){
        $empleado = new Empleado();
        $data['pageTitle']= 'CheckList Baja Empleado';
        $data['empleado'] = $empleado->where('id',$id)->first();
        return view('empleados/checkListEmpleado',$data);
    }


}
?>
