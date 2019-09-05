<?php
class PermissionsController extends Controller {
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
        $data = array();
        $permissions = new Permissions();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());        
        if ($this->user->hasPermission('permissao_view')) {                        
            $data['permissions_add'] = $this->user->hasPermission('permissao_add');
            $data['permissions_addgroup'] = $this->user->hasPermission('permissao_addgroup');
            $data['permission_list'] = $permissions->getList();
            $data['permission_groups_list'] = $permissions->getGroupList();
            $this->loadTemplate('permissions', $data);
        } else {            
            header("Location: " . BASE_URL);
        }
    }

    public function add() {
        $data = array();
        $data['nome_usuario'] = $this->user->getName();    
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('permissao_add')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = addslashes($_POST['name']);
                $permissions->add($pname);
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }
            $this->loadTemplate('permissions_add', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }
    public function add_group() {
        $data = array();
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if ($this->user->hasPermission('permissao_addgroup')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = strtoupper(addslashes($_POST['name']));
                $plist = $_POST['permissions'];
                $permissions->addGroup($pname, $plist);
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }
            $data['permissions_list'] = $permissions->getList();
            $this->loadTemplate('permissions_addgroup', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function delete($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());       
        if ($this->user->hasPermission('permissao_view')) {
            $permissions = new Permissions();
            $permissions->delete($id);
            header("Location: " . BASE_URL . "/permissions");
        } else {
            header("Location: " . BASE_URL);
        }
    }
    public function delete_group($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());       
        if ($this->user->hasPermission('permissao_view')) {
            $permissions = new Permissions();
            $permissions->deleteGroup($id);
            header("Location: " . BASE_URL . "/permissions");
        } else {
            header("Location: " . BASE_URL);
        }
    }
    public function edit_group($id) {
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());       
        if ($this->user->hasPermission('permissao_view')) {
            $permissions = new Permissions();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $pname = strtoupper(addslashes($_POST['name']));
                $plist = $_POST['permissions'];
                $permissions->editGroup($pname, $plist, $id);
                header("Location: " . BASE_URL . "/permissions");
                exit();
            }
            $data['permissions_list'] = $permissions->getList();
            $data['group_info'] = $permissions->getGroup($id);
            $this->loadTemplate('permissions_editgroup', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

}