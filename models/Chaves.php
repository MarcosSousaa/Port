<?php

class Chaves extends Model{
	public function getList($offset){
		$sql = "SELECT * FROM chaves LIMIT $offset, 10";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			return $stmt->fetchAll();
		}
	}

	public function getCount(){
		$sql = "SELECT COUNT(*) as c FROM chaves";
        $stmt = $this->db->prepare($sql);        
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['c'];
	}

	public function getInfo($id){
		$array = array();
		$sql = "SELECT * FROM chaves WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}

		return $array;
	}

	public function add($cod, $local){
		$sql = "INSERT INTO chaves SET cod = :cod, local = :local";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":cod", $cod);
		$stmt->bindParam(":local", $local);
		$stmt->execute();

	}

	public function edit($cod,$local,$status, $id){
		$sql = "UPDATE chaves SET cod = :cod, local = :local, status = :status WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":cod", $cod);
		$stmt->bindParam(":local", $local);
		$stmt->bindParam(":status", $status);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	public function inat($id){
		$sql = "UPDATE chaves SET status = 'I' WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		
	}

	public function getChaves(){
		$data = "";
		$sql = "SELECT id,cod,local FROM chaves";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll();
			$data = "<option value='0' disabled selected >Selecione uma chave </option>";

			foreach($result as $row){
				$data .= "<option value='".$row['id']."'>".$row['cod']." - ".$row['local']."</option>";
			}			
		}
		return $data;
	}

	public function getChaveFiltrada($chave_name,$local_name){
		$sql = "SELECT cod,local FROM chaves ";
		$where = array();

		if(!empty($chave_name)){
			$where[] = "WHERE chaves.cod LIKE '%".$chave_name."%'";
		}

		if(!empty($chave_local)){
			if(!empty($chave_name)){
				$where[] = "chaves.local LIKE '%".$local_name."%'";
			}else{
				$where[] = "WHERE chaves.local LIKE '%".$local_name."%'";	
			}
			
		}
		$sql .= implode(' AND ', $where);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
        if($stmt->rowCount() > 0){
        	return $stmt->fetchAll();
        }
        return null;


	}
}

?>