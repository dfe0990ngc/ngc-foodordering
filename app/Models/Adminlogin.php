<?php 
namespace App\Models;
use CodeIgniter\Model;

class Adminlogin extends Model {
        public function adminLogin($uname="",$pass=""){
                $sql = "SELECT * FROM employees WHERE username=? AND 
                        password=?";
                $result = $this->db->query($sql,[$uname,$pass]);

                return $result->getRow();
        }
}