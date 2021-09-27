<?php 
namespace App\Models;
use CodeIgniter\Model;

class Categories extends Model {
        public function getCategories($search){
                $sql = "
                        SELECT ct.*,ctp.name as CParent FROM categories ct
                        LEFT JOIN categories ctp ON(ctp.ID=ct.parent)
                        WHERE CONCAT_WS('',',',ct.name,ct.description) 
                        LIKE '%".$search."%' LIMIT 20
                ";

                $result = $this->db->query($sql);
                return $result->getResultArray("Array");
        }
        public function getCategoriesEx($ID){
                $sql = "
                        SELECT ct.* FROM categories ct
                        WHERE ID<>?
                ";

                $result = $this->db->query($sql,$ID);
                return $result->getResultArray("Array");
        }
        public function getCategory($ID){
                $sql = "
                        SELECT * FROM categories 
                        WHERE ID=?
                ";

                $result = $this->db->query($sql,$ID);
                return $result->getRow();
        }
        public function deleteCategory($ID){
                $sql = "
                        DELETE FROM categories 
                        WHERE ID=?
                ";

                $result = $this->db->query($sql,$ID);
                return $result;
        }
        public function insertCategory($data){
                $sql = "
                        INSERT INTO categories SET 
                        ID=?,
                        name=?,
                        description=?,
                        parent=?,
                        active=?
                        ON DUPLICATE KEY UPDATE 
                        name=?,
                        description=?,
                        parent=?,
                        active=?
                ";

                $result = $this->db->query($sql,$data);

                return $result;
        }
}