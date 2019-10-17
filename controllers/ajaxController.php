<?php 
class AjaxController extends Controller {
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
        
    }

    public function buscaChaves(){
        $data = array();
        $chaves = new Chaves();
        $data = $chaves->getChaves();              
        echo $data;
    }

    public function buscaVeiculos(){
        $filtro = addslashes($_POST['filtro']);
        $veiculos = new Veiculos();
        $data = $veiculos->buscaVeiculos($filtro);
        echo json_encode($data);
    }

    public function cadVeiculos(){
        $tipo = addslashes($_POST['tipo']);
        $motorista = addslashes($_POST['motorista']);
        $placa = addslashes($_POST['placa']);
        $empresa = addslashes($_POST['empresa']);    
        $veiculos = new Veiculos();
        $veiculos->add($tipo,$motorista,$placa,$empresa);        
    }
}