<?php 
namespace App\Controllers;
use App\Models\Usuario;


class LoginController extends BaseController{
    
    private $usuario;

    public function index(){
        //$encrypter = \Config\Services::encrypter();
        //$clave = bin2hex($encrypter->encrypt(1234567));
        //echo $clave;
        return view('Login/index');
    }

    public function validarIngreso(){
        $emailUsuario = $this->request->getPost("emailUsuario");
        $this->usuario = new Usuario();
        $resultadoUsuario = $this->usuario->buscarUsuarioPorEmail($emailUsuario);
        
        if($resultadoUsuario){
            $encrypter = \Config\Services::encrypter();
            $claveDB = $encrypter->decrypt(hex2bin($resultadoUsuario->password));

            $clave = $this->request->getPost("clave");
            if($clave == $claveDB){
                $data = [
                        "id"=>$resultadoUsuario->id,
                        "username"=>$resultadoUsuario->username,
                        "email"=>$resultadoUsuario->email,
                        "tipo"=>$resultadoUsuario->tipo
                    ];
                session()->set($data);
                return redirect()->to(base_url('/home'));
                
            }else{
                $data = ['tipo' =>'danger','mensaje' => 'Contraseña incorrecta'];
                return view('Login/index',$data);
            }

        }else{
            $data = ['tipo' =>'danger','mensaje' => 'Usuario incorrecto'];
            return view('Login/index',$data);
        }
    }

    public function CerrarSesion(){
        session()->destroy();
        return redirect()->to(base_url());
    }

}