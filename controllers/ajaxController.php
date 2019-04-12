<?php 
class ajaxController extends Controller {
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
    public function search_clients() {
        $data = array();
        $c = new Clients();
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $name = addslashes($_GET['query']);
            $clients = $c->searchClientsByName($name, $this->user->getCompany());
            foreach ($clients as $citem) {
                $data[] = array(
                    'name' => $citem['name'],
                    'link' => BASE_URL . '/clients/edit/' . $citem['id'],
                    'id' => $citem['id']
                );
            }
        }
        echo json_encode($data);
    }
    public function search_inventory() {
        $data = array();
        $i = new Inventory();
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $name = addslashes($_GET['query']);
            $products = $i->searchInventoryByName($name, $this->user->getCompany());
            foreach ($products as $product) {
                $data[] = array(
                    'name' => $product['name'],
                    'link' => BASE_URL . '/inventory/edit/' . $product['id']
                        //'id' => $product['id']
                );
            }
        }
        echo json_encode($data);
    }
    public function search_products() {
        $data = array();
        $i = new Inventory();
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $name = addslashes($_GET['query']);
            $products = $i->serchProductsByName($name, $this->user->getCompany());
            foreach ($products as $pitem) {
                $data[] = array(
                    'name' => $pitem['name'],
                    'id' => $pitem['id'],
                    'price' => $pitem['price']
                );
            }
        }
        echo json_encode($data);
    }
    public function add_client() {
        $data = array();
        $c = new Clients();
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);
            $data['id'] = $c->add($this->user->getCompany(), $name);
        }
        echo json_encode($data);
    }
    public function get_city_list() {
        $data = array();
        $cidade = new Cidade();
        
        if (isset($_GET['state']) && !empty($_GET['state'])) {
            $state = addslashes($_GET['state']);
            $data['cities'] = $cidade->getCityList($state);
        }
        echo json_encode($data);
    }

    public function buscaPorData(){
        $data = array();
        $r = new Records();        

        if(isset($_POST['data1']) && !empty($_POST['data1'])){            
            $data1 = addslashes($_POST['data1']);
            $data2 = addslashes($_POST['data2']);
            $tipo = addslashes($_POST['tipo']);
            echo "DATA-1 : ". $data1. "<br/> DATA-2 : ". $data2. " <br> TIPO : ".$tipo;
            exit;
            //$data['records_list'] = $r->getList($data1, $data2, $tipo);
        }
        else{
            $data1 = date('d-m-Y');
            $data2 = date('d-m-Y');
        }

        echo json_encode($data1);
      
    }
}