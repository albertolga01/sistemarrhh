<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Candidato;
use App\Models\Empleado;

use CodeIgniter\I18n\Time;
use App\Models\Actividad;

class CandidatoController extends Controller{

    public function index(){            
        $candidato = new Candidato();                             
        $data['pageTitle']= 'Candidatos';         
        $data['candidatos'] = $candidato->findAll();        
        return view('candidatos/candidatos',$data);        
    }


    public function guardarCandidato(){
        $candidato = new Candidato();
        $usuario = $this->request->getVar('Username');        

        $psicometrico = $this->request->getVar('psicometrico');        
        if($psicometrico != 1){$psicometrico = 0;}

        $datos=[  
            'nombreCandidato'=> $this->request->getVar('nombreCandidato'),
            'fechaEntrevista' => $this->request->getVar('fechaEntrevista'),
            'psicometrico' => $psicometrico,
            'referencias' => $this->request->getVar('referencias'),   
            'comentarios' => $this->request->getVar('comentarios'),
            'puesto' => $this->request->getVar('puesto'),
            'telefono' => $this->request->getVar('telefono'),
            'correo' => $this->request->getVar('correo')
        ];

        $candidato->insert($datos);  


        $actividad = new Actividad();   
        $nombreCandidato = $this->request->getVar('nombreCandidato');
        $cambio = "Se agregó el candidato " . $nombreCandidato;        
        $hoy = new Time();
        $datosActividad=[
            'idUsuario' => $this->request->getVar('Username'),
            'cambio' => $cambio,
            'fechaCambio' => $hoy
        ];
        $actividad->insert($datosActividad);
        return $this->response->redirect(base_url('/candidatos'));
    }


}
?>
