<?php

namespace App\Controllers;


class HomeController extends BaseController
{
    //protected $helpers = ['url', 'form'];


    public function index(){
                
        $data['pageTitle']= 'Home';
        return view('dashboard/index',$data);
    }

}