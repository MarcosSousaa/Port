<?php 

class Controller{
	public function __construct(){

	}

	public function loadView($viewName, $viewData = array()){
		/** extract transformar as chaves do array em variaveis para acessar na view
         *  $viewData = array('nome' => 'Teste', 'idade' => 20);
         *  $nome = teste;
         *  $idade = 20;
         */
		extract($viewData);
        if(file_exists('./views/'. $viewName . '.php')){
            include './views/'. $viewName . '.php';    
        }
		
	}

	public function loadTemplate($viewName, $viewData = array()) {
        include './views/template.php';
    }
    
    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include './views/' . $viewName . '.php';
    }

}