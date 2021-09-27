<?php

namespace App\Controllers;
use CodeIgniter\Controller;

// ini_set('memory_limit', '1024M');
class Employees extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    function getEmployees(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $Employees = new \App\Models\Employees();

        $search = '';

        if($this->request->getPostGet("search")){
            $search = $this->request->getPostGet("search");
        }

        $result = $Employees->getEmployees($search);

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Employee Management';
        $data['EMPLOYEES'] = $result;

        echo view("templates/admin_header",$header);
        echo view("admin_pages/employees",$data);
        echo view("templates/admin_footer",$footer);
    }
    function addEmployee(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Add Employee';
        $data['EMPLOYEES'] = '';

        echo view("templates/admin_header",$header);
        echo view("admin_pages/employees_add",$data);
        echo view("templates/admin_footer",$footer);
    }
    function editEmployee($ID){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Edit Employee';

        $Employees = new \App\Models\Employees();

        $res = $Employees->getEmployee($ID);
        if($res){
            $data['ID'] = $res->ID;
            $data['fname'] = $res->fname;
            $data['lname'] = $res->lname;
            $data['mname'] = $res->mname;
            $data['nname'] = $res->nname;
            $data['username'] = $res->username;
            $data['password'] = $res->password;
        }

        echo view("templates/admin_header",$header);
        echo view("admin_pages/employees_edit",$data);
        echo view("templates/admin_footer",$footer);
    }
    function deleteEmployee($ID){

        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Edit Employee';

        $Employees = new \App\Models\Employees();

        $res = $Employees->deleteEmployee($ID);
        if($res)
            session()->setFlashdata('SUCCESS','Record has been successfully deleted!');
        else
            session()->setFlashdata('FAILED','There are errors on deleting the record!');

        return redirect()->to(site_url('getEmployees'));
    }
    function saveEmployee(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $validation =  \Config\Services::validation();

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="EMPLOYEES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Employees';
        $data['EMPLOYEES'] = '';

        $validation=$this->validate([
            'fname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'First name is required!'
                ]
            ],
            'lname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Last name is required!'
                ]
            ],
            'nname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nick name is required!'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'user name is required!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password is required!'
                ]
            ]
        ]);


        echo view("templates/admin_header",$header);

        if(!$validation){
            $data['validation'] = $this->validator;
            echo view("admin_pages/employees_add",$data);
        }else{
            $ID = $this->request->getPost("ID");
            $fname = $this->request->getPost("fname");
            $lname = $this->request->getPost("lname");
            $mname = $this->request->getPost("mname");
            $nname = $this->request->getPost("nname");
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");

            if(!$ID){
                $ID=0;
            }

            $Employees = new \App\Models\Employees();
            $res = $Employees->insertEmployee([
                $ID,
                $fname,
                $lname,
                $mname,
                $nname,
                $username,
                $password,
                $fname,
                $lname,
                $mname,
                $nname,
                $username,
                $password
            ]);

            if($res){
                if($ID>0)
                    session()->setFlashdata('SUCCESS','Record has been successfully updated!');
                else
                    session()->setFlashdata('SUCCESS','New employee has been successfully added!');
                return redirect()->to(site_url('getEmployees'));
            }else{
                session()->setFlashdata('FAILED','Something went wrong!');
                echo view("admin_pages/employees_add",$data);
            }
        }

        echo view("templates/admin_footer",$footer);
    }
}
