<?php

	class KeysController extends Controller{

		private $user;
    	public function __construct() {
	        parent::__construct();
	        $this->user = new Users();
	        if (!$this->user->isLogged()) {
	            header("Location: " . BASE_URL . "/login");
	            exit();
	        }
	        $this->user->setLoggedUser();
    	}
	    public function index() {
	        // informações para o template
	        $data['nome_usuario'] = $this->user->getName();
	             
	        if ($this->user->hasPermission('keys_view')) { 
	        	$k = new Keys();
	        	$offset = 0; 

	        	//questão com paginação
	            $data['p'] = 1;
	            if (isset($_GET['p']) && !empty($_GET['p'])) {
	                $data['p'] = intval($_GET['p']);
	                if ($data['p'] == 0) {
	                    $data['p'] = 1;
	            	}
	        	}
	            $offset = (10 * ($data['p'] - 1));
	            if(isset($_POST['data1']) && !empty($_POST['data2'])){
	                $data1 = addslashes($_POST['data1']);
	                $data2 = addslashes($_POST['data2']);
	            }
	            else{
	                $data1 = date('Y-m-d');
	                $data2 = date('Y-m-d');
	            }        
	            $data['keys_list'] = $k->getList($data1,$data2,$offset);
	            //$data['records_count'] = $r->getCount();
	            //$data['p_count'] = ceil($data['records_count'] / 10); //sempre arredonda pra cima
	            

	            $this->loadTemplate('records', $data);
	        } 
	        else {            
	            header("Location: " . BASE_URL);
	        }
	    }












	}








?>