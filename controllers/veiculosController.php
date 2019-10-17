<?php
class VeiculosController extends Controller {
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
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('veiculos_view')) { 
        	$v = new Veiculos();
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

            $data['veiculos_list'] = $v->getList($offset);
            $data['veiculos_count'] = $v->getCount();
            $data['p_count'] = ceil($data['veiculos_count'] / 10); //sempre arredonda pra cima

            $this->loadTemplate('veiculos', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('veiculos_add')) { 
        	$v = new Veiculos();
        	if(isset($_POST['motorista']) && !empty($_POST['motorista'])){
        		 $tipo = strtoupper(addslashes($_POST['tipo']));
        		 $motorista = strtoupper(addslashes($_POST['motorista']));
        		 $placa = strtoupper(addslashes($_POST['placa']));
        		 $placa = str_replace("-", "", $placa);
        		 $empresa = strtoupper(addslashes($_POST['empresa']));
        		 $v->add($tipo,$motorista,$placa,$empresa);
        		 header("Location:". BASE_URL.'/veiculos');
        	}
        	
            $this->loadTemplate('veiculos_add', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function edit($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('veiculos_edit')) { 
        	$v = new Veiculos();
        	if(isset($_POST['motorista']) && !empty($_POST['motorista'])){        		
    		  $motorista = strtoupper(addslashes($_POST['motorista']));	 
    		  $empresa = strtoupper(addslashes($_POST['empresa']));
              $placa = strtoupper(addslashes($_POST['placa']));
              $status = strtoupper(addslashes($_POST['status']));
		      $v->edit($motorista, $empresa, $status,$placa, $id);
        		 header("Location:". BASE_URL.'/veiculos');
        	}
        	
        	$data['veiculos_info'] = $v->getInfo($id);            
            $this->loadTemplate('veiculos_edit', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

     public function view($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('veiculos_edit')) { 
            $v = new Veiculos();
            
            $data['veiculos_info'] = $v->getInfo($id);            
            $this->loadTemplate('veiculos_view', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function inat($id){
        $data = array();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());     
        if ($this->user->hasPermission('veiculos_del')) {
            $v = new Veiculos();
            $v->inat($id);
            header("Location: " . BASE_URL . "/veiculos");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
}