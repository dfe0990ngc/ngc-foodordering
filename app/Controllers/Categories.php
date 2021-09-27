<?php

namespace App\Controllers;
use CodeIgniter\Controller;

// ini_set('memory_limit', '1024M');
class Categories extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    function getCategories(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $Categories = new \App\Models\Categories();

        $search = '';

        if($this->request->getPostGet("search")){
            $search = $this->request->getPostGet("search");
        }

        $result = $Categories->getCategories($search);

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="CATEGORIES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Category Management';
        $data['CATEGORIES'] = $result;

        echo view("templates/admin_header",$header);
        echo view("admin_pages/categories",$data);
        echo view("templates/admin_footer",$footer);
    }
    function addCategory(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="CATEGORIES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Add Category';

        $ID = 0;

        $Categories = new \App\Models\Categories();
        $res = $Categories->getCategoriesEX($ID);

        $data['PCATEGORIES'] = $res;


        echo view("templates/admin_header",$header);
        echo view("admin_pages/categories_add",$data);
        echo view("templates/admin_footer",$footer);
    }
    function editCategory($ID){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="CATEGORIES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Edit Category';
        $Categories = new \App\Models\Categories();

        $res = $Categories->getCategory($ID);
        if($res){
            $ID = $res->ID;
            $data['ID'] = $res->ID;
            $data['name'] = $res->name;
            $data['description'] = $res->description;
            $data['parent'] = $res->parent;
            $data['active'] = $res->active?1:0;
        }

        $res = $Categories->getCategoriesEX($ID);

        $data['PCATEGORIES'] = $res;

        echo view("templates/admin_header",$header);
        echo view("admin_pages/categories_edit",$data);
        echo view("templates/admin_footer",$footer);
    }
    function deleteCategory($ID){

        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="CATEGORIES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Edit Category';

        $Categories = new \App\Models\Categories();

        $res = $Categories->deleteCategory($ID);
        if($res)
            session()->setFlashdata('SUCCESS','Record has been successfully deleted!');
        else
            session()->setFlashdata('FAILED','There are errors on deleting the record!');

        return redirect()->to(site_url('getCategories'));
    }
    function saveCategory(){
        if(session()->get("USERNAME")===null)
            return redirect()->to(site_url('adminpage'));

        $validation =  \Config\Services::validation();

        $header['isLoginPage']=false;
        $header['SITE_TITLE']="Food Ordering Managemenr System";
        $header['ACTIVE_MENU']="CATEGORIES";
        $footer = [];

        $data['MODULE_TITLE'] = 'Edit Category';

        $validation=$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Category name is required!'
                ]
            ]
        ]);

        $ID = 0;
        if($this->request->getPost('ID')){
            $ID = $this->request->getPost('ID');
        }

        $Categories = new \App\Models\Categories();
        $res = $Categories->getCategoriesEX($ID);

        $data['PCATEGORIES'] = $res;

        echo view("templates/admin_header",$header);

        if(!$validation){
            $data['validation'] = $this->validator;
            echo view("admin_pages/categories_add",$data);
        }else{
            $ID = $this->request->getPost("ID");
            $name = $this->request->getPost("name");
            $description = $this->request->getPost("description");
            $parent = $this->request->getPost("parent");
            $active = $this->request->getPost("active");
            $active = $active=='on'?1:($active=='true'?1:0);

            if(!$ID){
                $ID=0;
            }

            $Categories = new \App\Models\Categories();
            $res = $Categories->insertCategory([
                $ID,
                $name,
                $description,
                $parent,
                $active,
                $name,
                $description,
                $parent,
                $active
            ]);

            if($res){
                if($ID>0)
                    session()->setFlashdata('SUCCESS','Record has been successfully updated!');
                else
                    session()->setFlashdata('SUCCESS','New category has been successfully added!');
                return redirect()->to(site_url('getCategories'));
            }else{
                session()->setFlashdata('FAILED','Something went wrong!');
                echo view("admin_pages/categories_add",$data);
            }
        }
        echo view("templates/admin_footer",$footer);
    }
}
