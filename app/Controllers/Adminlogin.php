<?php

namespace App\Controllers;
use CodeIgniter\Controller;

// ini_set('memory_limit', '1024M');
class Adminlogin extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    function adminpage(){
        session()->destroy();

        $header['isLoginPage']=true;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $footer = [];
        $data = [];
        $header['ACTIVE_MENU']="EMPLOYEES";

        echo view("templates/admin_header",$header);
        echo view("admin_pages/login",$data);
        echo view("templates/admin_footer",$footer);
    }
    function login($uname="",$pass=""){
        $AdminLogin = new \App\Models\AdminLogin();

        $header['isLoginPage']=true;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Employees';

        echo view("templates/admin_header",$header);

        if(session()->get("USERNAME")){
            return redirect()->to(site_url('getEmployees'));
        }else{            
            $uname = $this->request->getPostGet('uname');
            $upass = $this->request->getPostGet('upass');

            if($uname){
                $res = $AdminLogin->adminLogin($uname,$upass);

                if($res){
                    session()->set('USERID',$res->ID);
                    session()->set('USERNAME',$res->nname);
                    return redirect()->to(site_url('getEmployees'));
                }else{
                    session()->setFlashdata("invalid","Invalid credentials!");
                    echo view("admin_pages/login",$data);
                }
            }else
                echo view("admin_pages/login",$data);
        }

        echo view("templates/admin_footer",$footer);
    }
}
