<?php
class UsersController extends Controller {
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
        if ($this->user->hasPermission('usuario_view')) {            
            $data['users_list'] = $this->user->getList();
            $this->loadTemplate('users', $data);
        } else {            
            header("Location: " . BASE_URL);
        }
    }
    public function add() {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());    
        if ($this->user->hasPermission('usuario_view')) {
            $p = new Permissions();
            $data['group_list'] = $p->getGroupList();
            if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {                
                $cpf = addslashes($_POST['cpf']);
                $cpf = str_replace(".", "", $cpf);
                $cpf = str_replace("-", "", $cpf);
                $name = addslashes($_POST['name']);
                $turno = addslashes($_POST['turno']);
                $group = addslashes($_POST['group']);
                $retorno = $this->user->add($cpf, $name, $turno, $group);
                if ($retorno) {
                    header("Location: " . BASE_URL . "/users");
                    exit();
                } else {
                    $data['error_msg'] = "Usuário já existe!";
                }
            }
            $this->loadTemplate('users_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    public function edit($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());     
        if ($this->user->hasPermission('usuario_view')) {
            $p = new Permissions();
            $data['user_info'] = $this->user->getInfo($id);
            $data['group_list'] = $p->getGroupList();
            if (isset($_POST['group']) && !empty($_POST['group'])) {
                $name = addslashes($_POST['name']);
                $turno = addslashes($_POST['turno']);
                $group = addslashes($_POST['group']);
                $this->user->edit($name, $turno, $group, $id);
                header("Location: " . BASE_URL . "/users");
                exit();
            }
            $this->loadTemplate('users_edit', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    public function delete($id) {
        $data = array();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());     
        if ($this->user->hasPermission('usuario_view')) {
            $p = new Permissions();
            $this->user->delete($id);
            header("Location: " . BASE_URL . "/users");
            exit();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
}