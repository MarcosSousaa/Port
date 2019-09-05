<?php
class Permissions extends Model {
    private $group;
    private $permissions;
    public function setGroup($id) {
        // consultando quais os params que tem esse grupo
        $this->group = $id;
        $this->permissions = array();
        $sql = "SELECT params FROM groups WHERE id = :id ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if (empty($row['params'])) {
                $row['params'] = '0';
            }
            $params = $row['params'];
            /** consultando esses 'params' para saber quais os nomes
              e no final adicionar cada nome ao array de $this->permissions * */            
            $this->searchingNameOfParameters($params);
        }
    }
    private function searchingNameOfParameters($params) {        
        $sql = "SELECT name FROM permissions WHERE id IN ($params)";
        $stmt = $this->db->prepare($sql);        
        $stmt->execute();        
        if ($stmt->rowCount() > 0) {
            $p = $stmt->fetchAll();
            foreach ($p as $item) {
                $this->permissions[] = $item['name'];
            }                        
        }
    }
    public function hasPermission($name) {        
        if (in_array($name, $this->permissions)) {
            return true;
        }
        return false;
    }

    public function getList() {
        $array = array();
        $stmt = $this->db->prepare("SELECT * FROM permissions");        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }
        return $array;
    }
    public function getGroupList() {
        $array = array();
        $stmt = $this->db->prepare("SELECT * FROM groups ");        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }
        return $array;
    }
    public function getGroup($id) {
        $array = array();
        $stmt = $this->db->prepare("SELECT * FROM groups WHERE id = :id");
        $stmt->bindParam(':id', $id);        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetch();
            $array['params'] = explode(",", $array['params']);
        }
        return $array;
    }
    public function add($name) {
        $sql = "INSERT INTO permissions SET name = :name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);        
        $stmt->execute();
    }
    public function addGroup($name, $plist) {
        $params = implode(",", $plist);
        $sql = "INSERT INTO groups SET name = :name, params = :params";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);        
        $stmt->bindParam(':params', $params);
        $stmt->execute();
    }
    public function editGroup($name, $plist, $id) {
        $params = implode(",", $plist);
        $sql = "UPDATE groups SET name = :name, params = :params WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);        
        $stmt->bindParam(':params', $params);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function delete($id) {
        $sql = "DELETE FROM permissions WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function deleteGroup($id) {
        $u = new Users();
        // verifica se tem algum usuario associado a este grupo
        if ($u->findUsersInGroup($id) == false) {
            $sql = "DELETE FROM groups WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }

    public function grupoPorUsuario($cpf){
        $sql = "SELECT groups.name FROM users INNER JOIN groups ON users.id_group = groups.id WHERE users.cpf = :cpf";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetch();
        }
        return false;
    }
}