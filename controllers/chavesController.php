<?php
class ChavesController extends Controller {
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
             
        if ($this->user->hasPermission('chaves_view')) { 
        	$c = new Chaves();
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

            $data['chaves_list'] = $c->getList($offset);
            $data['chaves_count'] = $c->getCount();
            $data['p_count'] = ceil($data['chaves_count'] / 10); //sempre arredonda pra cima
            

            $this->loadTemplate('chaves', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
             
        if ($this->user->hasPermission('chaves_add')) { 
        	$c = new Chaves();
        	if(isset($_POST['cod']) && !empty($_POST['cod'])){
        		 $cod = strtoupper(addslashes($_POST['cod']));
        		 $local = strtoupper(addslashes($_POST['local']));        		 
        		 $c->add($cod,$local);
        		 header("Location:". BASE_URL.'/chaves');
        	}
        	
            $this->loadTemplate('chaves_add', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function edit($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
             
        if ($this->user->hasPermission('chaves_edit')) { 
        	$c = new Chaves();
        	if(isset($_POST['cod']) && !empty($_POST['cod'])){        		
                $cod = strtoupper(addslashes($_POST['cod']));        		 
                $local = strtoupper(addslashes($_POST['local']));
                $status = strtoupper(addslashes($_POST['status']));
                
                $c->edit($cod, $local, $status, $id);
                header("Location:". BASE_URL.'/chaves');
        	}
        	
        	$data['chaves_info'] = $c->getInfo($id);
            $this->loadTemplate('chaves_edit', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function inative($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
             
        if ($this->user->hasPermission('chaves_edit')) { 
            $c = new Chaves();            
            $c->inat($id);
            header("Location:". BASE_URL.'/chaves');            
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }

    public function view($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
             
        if ($this->user->hasPermission('chaves_edit')) { 
            $c = new Chaves();            
            $data['chaves_info'] = $c->getInfo($id);
            $this->loadTemplate('chaves_view', $data);
        } 
        else {            
            header("Location: " . BASE_URL);
        }
    }
}