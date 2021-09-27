<?php 
namespace App\Models;
use CodeIgniter\Model;

class Employees extends Model {
        public function getEmployees($search){
                $sql = "
                        SELECT * FROM employees 
                        WHERE CONCAT_WS('',',',fname,mname,lname,nname) 
                        LIKE '%".$search."%' LIMIT 20
                ";

                $result = $this->db->query($sql);
                return $result->getResultArray("Array");
        }
        public function getEmployee($ID){
                $sql = "
                        SELECT * FROM employees 
                        WHERE ID=?
                ";

                $result = $this->db->query($sql,$ID);
                return $result->getRow();
        }
        public function deleteEmployee($ID){
                $sql = "
                        DELETE FROM employees 
                        WHERE ID=?
                ";

                $result = $this->db->query($sql,$ID);
                return $result;
        }
        public function insertEmployee($data){
                $sql = "
                        INSERT INTO employees SET 
                        ID=?,
                        fname=?,
                        lname=?,
                        mname=?,
                        nname=?,
                        username=?,
                        password=?
                        ON DUPLICATE KEY UPDATE 
                        fname=?,
                        lname=?,
                        mname=?,
                        nname=?,
                        username=?,
                        password=?,
                        datejoined=CURRENT_TIMESTAMP
                ";

                $result = $this->db->query($sql,$data);

                return $result;
        }
}