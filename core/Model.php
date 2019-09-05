<?php 
error_reporting(0); //0 = DESABILITADO 1 = HABILITADO
class Model{
	// todos que 'extends Model' vão usar a variavel $db
    protected $db;
    public function __construct() {
        global $config;
        try{
            $this->db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['dbhost'].";charset=utf8",
                $config['dbuser'], $config['dbpass']);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        } catch (PDOException $e) {
            echo "Falha ao conectar no banco ". $e->getMessage();                        
        }
        
    }
}	