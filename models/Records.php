<?php

class Records extends Model{
	
	public function getList($data1,$data2,$tipo){
		$array = array();

		if($tipo == '0'){			
			$sql = "SELECT registros.id,registros.tipo,registros.data_er,registros.hora_er,registros.colab_ret, registros.flag, chaves.cod,chaves.local FROM registros INNER JOIN chaves ON registros.chaves_id = chaves.id WHERE registros.tipo = :tipo AND registros.data_er BETWEEN :data1 AND :data2 /*AND registros.flag = '1'*/ ORDER BY registros.data_er,registros.hora_er";	
		}
		else if($tipo == '1'){			
			$sql = "SELECT registros.id,registros.tipo,registros.data_er,registros.hora_er,registros.tipo_v,registros.placa_v,registros.motorista_v, registros.flag,registros.rg, registros.empresa_v, registros.obs FROM registros WHERE registros.tipo = :tipo AND registros.data_er BETWEEN :data1 AND :data2 /*AND registros.flag = '1'*/ ORDER BY registros.data_er,registros.hora_er";
	
		}
		else if($tipo == '2'){			
			$sql = "SELECT registros.id,registros.tipo,registros.visitante,registros.data_er,registros.hora_er, registros.flag, veiculos.placa, registros.placa_v,registros.rg, veiculos.motorista, registros.motorista_v, veiculos.empresa, registros.empresa_v, registros.obs FROM registros LEFT OUTER JOIN veiculos ON registros.veiculos_id = veiculos.id WHERE registros.tipo = :tipo AND registros.data_er BETWEEN :data1 AND :data2 /*AND registros.flag = '1'*/ORDER BY registros.data_er,registros.hora_er";
		}	
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':tipo',$tipo);
		$stmt->bindValue(':data1',$data1);
		$stmt->bindValue(':data2',$data2);
		$stmt->execute();	
		if($stmt->rowCount() > 0){
			$array =  $stmt->fetchAll();
		}
		return $array;
	}

	public function getInfo($id){
		$array = array();
		$sql = "SELECT registros.tipo as tipov,registros.*,chaves.*,veiculos.* FROM registros LEFT OUTER JOIN veiculos on registros.veiculos_id = veiculos.id LEFT OUTER JOIN chaves on registros.chaves_id = chaves.id WHERE registros.id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}	

	public function getCount($tipo){
		$sql = "SELECT COUNT(*) as c FROM registros WHERE tipo = :tipo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":tipo", $tipo);        
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['c'];
	}

	public function add($tipo,$data_er,$hora_er,$colab_ret = '', $tipo_vr = '', $placa_vr = '', $motorista_vr = '', $rg = '', $empresa_vr = '' , $veiculos_id = '',$chaves_id = '',$obs = '',$visitante = ''){
		if($tipo == '0'){
			$sql = "INSERT INTO registros (tipo,data_er,hora_er,colab_ret,chaves_id) VALUES(:tipo,:data_er,:hora_er,:colab_ret,:chaves_id)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":tipo", $tipo);
			$stmt->bindValue(":data_er", $data_er);
			$stmt->bindValue(":hora_er", $hora_er);
			$stmt->bindValue(":colab_ret", $colab_ret);
			$stmt->bindValue(":chaves_id", $chaves_id);			
		}
		else if($tipo == '1'){
			$sql = "INSERT INTO registros (tipo,data_er,hora_er,tipo_v,placa_v,motorista_v,rg,empresa_v,obs) VALUES(:tipo,:data_er,:hora_er,:tipo_v,:placa,:motorista,:rg,:empresa,:obs)";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":tipo", $tipo);
			$stmt->bindValue(":data_er", $data_er);
			$stmt->bindValue(":hora_er", $hora_er);
			$stmt->bindValue(":tipo_v", $tipo_vr);
			$stmt->bindValue(":placa", $placa_vr);			
			$stmt->bindValue(":motorista", $motorista_vr);
			$stmt->bindValue(":rg", $rg);			
			$stmt->bindValue(":empresa", $empresa_vr);
			$stmt->bindValue(":obs", $obs);
		}

		else if($tipo == '2'){
			if($visitante == '1'){
				$sql = "INSERT INTO registros(tipo,data_er,hora_er,placa_v,motorista_v,rg,empresa_v,obs,visitante)
				VALUES
				(:tipo,:data_er,:hora_er,:placa,:motorista,:rg,:empresa,:obs,:visitante)";
				$stmt = $this->db->prepare($sql);				
				$stmt->bindValue(":tipo", $tipo);
				$stmt->bindValue(":data_er", $data_er);
				$stmt->bindValue(":hora_er", $hora_er);
				$stmt->bindValue(":placa", $placa_vr);			
				$stmt->bindValue(":motorista", $motorista_vr);	
				$stmt->bindValue(":rg", $rg);			
				$stmt->bindValue(":empresa", $empresa_vr);
				$stmt->bindValue(":obs", $obs);
				$stmt->bindValue(":visitante", $visitante);
			}
			else {
				$sql = "INSERT INTO registros (tipo,data_er,hora_er,veiculos_id,obs,visitante) VALUES(:tipo,:data_er,:hora_er,:veiculos_id,:obs,:visitante)";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":tipo", $tipo);
				$stmt->bindValue(":data_er", $data_er);
				$stmt->bindValue(":hora_er", $hora_er);
				$stmt->bindValue(":veiculos_id", $veiculos_id);
				$stmt->bindValue(":obs", $obs);
				$stmt->bindValue(":visitante", $visitante);
			}			
		}		
		$stmt->execute();

	}

	public function edit($id,$data_sr,$hora_sr,$colab_dev,$obs,$hora_int_sai,$hora_int_en){		
		if(isset($colab_dev) && !empty($colab_dev)){			
			$sql = "UPDATE registros SET data_sr = :data_sr, hora_sr = :hora_sr, colab_dev = :colab_dev, flag = '2' WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			$stmt->bindValue(":data_sr" , $data_sr);
			$stmt->bindValue(":hora_sr" , $hora_sr);
			$stmt->bindValue(":colab_dev" , $colab_dev);
			$stmt->bindValue(":id" , $id);		

		}
		else {
			if(isset($hora_sr) && !empty($hora_sr)){
				$sql = "UPDATE registros SET data_sr = :data_sr, hora_sr = :hora_sr, obs = :obs, hr_int_sai = :hr_int_sai, hr_int_en = :hr_int_en, flag = '2' WHERE id = :id";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":data_sr" , $data_sr);
				$stmt->bindValue(":hora_sr" , $hora_sr);
				$stmt->bindValue(":hr_int_sai" , $hora_int_sai);
				$stmt->bindValue(":hr_int_en" , $hora_int_en);
				$stmt->bindValue(":obs" , $obs);
				$stmt->bindValue(":id" , $id);	
			}
			else {				
				$sql = "UPDATE registros SET data_sr = :data_sr, obs = :obs, hr_int_sai = :hr_int_sai, hr_int_en = :hr_int_en WHERE id = :id";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":data_sr" , $data_sr);				
				$stmt->bindValue(":hr_int_sai" , $hora_int_sai);
				$stmt->bindValue(":hr_int_en" , $hora_int_en);
				$stmt->bindValue(":obs" , $obs);
				$stmt->bindValue(":id" , $id);				
			}			
			
		}		
		$stmt->execute();
	}

	public function getEntradaSaida($data1,$data2,$placa,$motorista,$empresa,$tipo){
		$sql = "SELECT 
					registros.data_er,
					registros.visitante, 
					registros.hora_er, 
					veiculos.motorista, 
					veiculos.placa, 
					veiculos.empresa,
					registros.motorista_v, 
					registros.rg, 
					registros.placa_v, 
					registros.empresa_v, 
					registros.data_sr,
					registros.hr_int_sai,
					registros.hr_int_en,
					registros.obs,  
					registros.hora_sr
					FROM registros
					LEFT OUTER JOIN veiculos ON registros.veiculos_id = veiculos.id
					WHERE ";
	 	$where = array();
	 	if(!empty($tipo)){
	 		$where[] = "registros.tipo = :tipo  ";
	 	} 	    
        if(!empty($data1) && !empty($data2) ){
        	$where[] = "registros.data_er BETWEEN :data1 AND :data2";	
        }
        if(!empty($motorista)){
            $where[] = "veiculos.motorista LIKE '%".$motorista."%'";
        }
        if(!empty($empresa)){
            $where[] = "veiculos.empresa LIKE '%".$empresa."%'";
        }
        if(!empty($placa)){
            $where[] = "veiculos.placa LIKE  '%".$placa."%'";
        }        
        $sql .= implode(' AND ', $where);
        $stmt = $this->db->prepare($sql);
        if(!empty($tipo)){
            $stmt->bindParam(":tipo", $tipo);                       
        }        
        if(!empty($data1) && !empty($data2)){
            $stmt->bindParam(":data1", $data1);   
            $stmt->bindParam(":data2", $data2);                
        }           	
        $stmt->execute();                	
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }
        return null;

	}

	public function getRecebColet($data1,$data2,$placa,$motorista,$empresa,$tipo){
		$sql = "SELECT 
					registros.data_er, 
					registros.hora_er, 
					registros.motorista_v, 
					registros.placa_v,
					registros.rg, 
					registros.empresa_v, 
					registros.data_sr,
					registros.obs,					
					registros.hora_sr
					FROM registros					
					WHERE ";
	 	$where = array();
	 	if(!empty($tipo)){
	 		$where[] = "registros.tipo = :tipo  ";
	 	} 	    
        if(!empty($data1) && !empty($data2) ){
        	$where[] = "registros.data_er BETWEEN :data1 AND :data2";	
        }
        if(!empty($motorista)){
            $where[] = "veiculos.motorista LIKE '%".$motorista."%'";
        }
        if(!empty($empresa)){
            $where[] = "veiculos.empresa LIKE '%".$empresa."%'";
        }
        if(!empty($placa)){
            $where[] = "veiculos.placa LIKE  '%".$placa."%'";
        }        
        $sql .= implode(' AND ', $where);
        $stmt = $this->db->prepare($sql);
        if(!empty($tipo)){
            $stmt->bindParam(":tipo", $tipo);                       
        }        
        if(!empty($data1) && !empty($data2)){
            $stmt->bindParam(":data1", $data1);   
            $stmt->bindParam(":data2", $data2);                
        }           	
        $stmt->execute();                	
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }
        return null;

	}

	public function getControleChaves($data1,$data2,$local,$tipo){
		$sql = "SELECT 
				registros.data_er,
				registros.hora_er,
                registros.colab_ret,
				chaves.cod, 
				chaves.local,
				registros.colab_dev,
				registros.data_sr, 
				registros.hora_sr   
			FROM registros
			INNER JOIN chaves ON registros.chaves_id = chaves.id
			WHERE ";
		$where = array();
		if(!empty($tipo)){
			$where[] = "registros.tipo = :tipo";			
		}

		if(!empty($data1) && !empty($data2)){
        	$where[] = "registros.data_er BETWEEN :data1 AND :data2";		
		}

		if(!empty($local)){
			$where[] = "chaves.local = :local";
		}
		 $sql .= implode(' AND ', $where);
		 $stmt = $this->db->prepare($sql);

		 if(!empty($tipo)){
            $stmt->bindParam(":tipo", $tipo);                       
        }        
        if(!empty($data1) && !empty($data2)){
            $stmt->bindParam(":data1", $data1);   
            $stmt->bindParam(":data2", $data2);                
        }
        if(!empty($local)){
        	$stmt->bindParam(":local", $local);
        }
        $stmt->execute();
        if($stmt->rowCount() > 0){
        	return $stmt->fetchAll();
        }

        return null;
	}
}