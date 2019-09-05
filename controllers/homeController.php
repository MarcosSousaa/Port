<?php

class HomeController extends Controller{
	private $user;	

	public function __construct(){
		parent::__construct();
		$this->user = new Users();		
		if(!$this->user->isLogged()){
			header("Location:" . BASE_URL . "/login");
		}

		$this->user->setLoggedUser();		
	}

	public function index(){
		$data = array();		
		$data['nome_usuario'] = $this->user->getName();		
		$data['acesso'] = $this->user->getGroupName($this->user->getCpf());
		$this->loadTemplate('home', $data);
		
	}
}