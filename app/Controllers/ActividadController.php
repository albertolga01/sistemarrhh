<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Actividad;
use App\Models\Usuario;


use CodeIgniter\I18n\Time;


class ActividadController extends Controller{

    public function index(){            
        $actividad = new Actividad();   
        $usuario = new Usuario();                             
        $data['pageTitle']= 'Historial';         
        $data['actividades'] = $actividad->select('actividades.idActividades,actividades.cambio,actividades.fechaCambio,usuarios.username')->join('usuarios', 'usuarios.id = actividades.idUsuario')->findAll();         
        return view('actividades/actividades',$data);        
    }





}
?>