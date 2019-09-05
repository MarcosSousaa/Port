<?php

class Users extends Model{
	private $userInfo;
	private $permissions;

	public function isLogged(){
		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])){
			return true;
		}

		return false;
	}

	public function doLogin($cpf){
        try{
            $sql = "SELECT * FROM users WHERE cpf = :cpf";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":cpf", $cpf);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();

                $_SESSION['ccUser'] = $row['cpf'];
                return true;
            }

            return false;    
        } catch(Exception $e){
            echo "ERRO AO BUSCAR INFO NO BD ".$e->getMessage();
        }
		
	}

	public function setLoggedUser(){
		if($this->isLogged()){
			$cpf = $_SESSION['ccUser'];

			$sql = "SELECT * FROM users WHERE cpf = :cpf";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":cpf", $cpf);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				$this->userInfo = $stmt->fetch();
				$this->permissions = new Permissions();
                // ao settar info's do usuario, vou settar o grupo que o mesmo pertence
                $this->permissions->setGroup($this->userInfo['id_group']);


			}
		}
	}

	public function logout(){
		unset($_SESSION['ccUser']);
	}

	public function hasPermission($name){
        return $this->permissions->hasPermission($name);

	}

	public function getName() {
        return $this->userInfo['name'];
    }
    
    public function getCpf() {
        return $this->userInfo['cpf'];
    }

    public function getGroupName($cpf){
        return $this->permissions->grupoPorUsuario($cpf);
    }

    public function getInfo($id) {
        $array = array();
        $sql = "SELECT * FROM users WHERE cpf = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetch();
        }
        return $array;
    }
    public function findUsersInGroup($id) {
        $sql = "SELECT COUNT(*) as c FROM users WHERE id_group = :group";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":group", $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row['c'] == '0') {
            return false;
        }
        return true;
    }
    public function getList() {
        $array = array();
        $sql = "SELECT u.cpf, u.name, pg.name as group_name 
                FROM users u
                INNER JOIN groups pg
                ON u.id_group = pg.id";
        $stmt = $this->db->prepare($sql);        
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $array = $stmt->fetchAll();
        }
        return $array;
    }

    public function add($cpf, $name, $turno, $group) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE cpf = :cpf");
        $stmt->bindParam(":cpf", $cpf);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row['c'] == '0') { //não há usuario cadastrado            
            $stmt = $this->db->prepare("INSERT INTO users SET cpf = :cpf, name = :name, turno = :turno, id_group = :id_group");
            $stmt->bindParam(":cpf", $cpf);            
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":turno", $turno);
            $stmt->bindParam(":id_group", $group);            
            $stmt->execute();
            return true;
        } else {
            return false;
            echo 'veio para aqui';
            exit();
        }
    }
    public function edit($name , $turno, $group, $id) {
        $sql = "UPDATE users SET name = :name, turno = :turno, id_group = :id_group WHERE cpf = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":turno", $turno);
        $stmt->bindParam(":id_group", $group);
        $stmt->bindParam(":id", $id);        
        $stmt->execute();
    }
    public function delete($id) {
        $sql = "DELETE FROM users WHERE cpf = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);        
        $stmt->execute();
    }
   
}