<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;

class UserController extends Controller{

    public function index(){        
        
        $usuario = new Usuario();
        $data['usuarios'] = $usuario->orderBy('id','ASC')->findAll();        
        $data['pageTitle']= 'Usuario';
        return view('usuarios/usuario',$data);
    }

    public function insertUsuario(){
        $usuario = new Usuario();   
        
        $validacion = $this->validate([
            'username'=>'required',
            'email'=>'required',
            'password' =>'required',
            'tipo'=>'required'
        ]);
        if(!$validacion){
            
            $session = session();
            $session->setFlashdata('mensaje','Revisa la información');

            return redirect()->back()->withInput();
            //return $this->response->redirect(site_url('/usuario'));
        }
        
        if($username=$this->request->getVar('username')){
            $password = $this->request->getVar('password');
            $encrypter = \Config\Services::encrypter();
            $password = bin2hex($encrypter->encrypt($password));

            $data=[
                'username'=> $this->request->getVar('username'),
                'email'=> $this->request->getVar('email'),
                'password'=> $password,
                'tipo' =>$this->request->getVar('tipo')                      
            ];
            $usuario->insert($data);           
        }        
        return $this->response->redirect(base_url('/usuario'));
    }

    public function deleteUsuario($id=null){
        $usuario = new Usuario();
        $datosUsuario = $usuario->where('id',$id)->first();

        //DELETE DEL ELEMENTO EN BASE DE DATOS
       $usuario->where('id',$id)->delete($id);
            

        return $this->response->redirect(base_url('/usuario'));
    }


    public function editUsuario($id=null){        
        $usuario = new Usuario();
        $data['usuario'] = $usuario->where('id',$id)->first();
        return view('usuarios/editarUsuario',$data);
    }

    public function editarUsuario(){
        $usuario = new Usuario();        
        $data=[
            'username'=> $this->request->getVar('username'),
            'email'=> $this->request->getVar('email'),
            'password'=> $this->request->getVar('password')                
        ];
        $id = $this->request->getVar('id');

        $usuario->update($id,$data);
        return $this->response->redirect(base_url('/usuario'));
    }
}
?>
