<?php
use Mpdf\Mpdf;
require_once './libs/vendor/autoload.php';
date_default_timezone_set('America/Sao_Paulo');
class ReportsController extends Controller {
	private $user;
	public function __construct(){
		$this->user = new Users();
		if(!$this->user->isLogged()){
			header("Location:".BASE_URL."login");
			exit();
		}
		$this->user->setLoggedUser();
	}

	public function index(){
		$data = array();
		// informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());		
		if($this->user->hasPermission('report_view')){
			$this->loadTemplate('report', $data);
		}else {
			header("Location:".BASE_URL);
		}
	}

	public function chaves(){
		$data = array();
		// informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if($this->user->hasPermission('report_chaves')){
        	$this->loadTemplate('report_chaves', $data);
        }else {
        	header("Location: ". BASE_URL);
        	exit();
        }		
	}

	public function chaves_pdf(){
		if($this->user->hasPermission('report_chaves')){
            $chave_name = addslashes($_GET['chave_name']);
            $local_name = addslashes($_GET['local_name']);            
            $chave = new Chaves();
            $data['chave_list'] = $chave->getChaveFiltrada($chave_name,$local_name);
            $data['filters'] = $_GET;
            ob_start(); //iniciando buffer [armazenando na memoria o que era pra ser carregado na view]            
            $this->loadView('report_chaves_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html
            ob_end_clean(); // zerando a memoria quanto a este processo
            $mpdf = new Mpdf();
            $mpdf->SetHeader('Portaria Ind Bandeirante| Relatório de Chaves Cadastradas |Pág. - {PAGENO}');
             $mpdf->SetFooter('Relatorio impresso :'.date('d/m/Y \à\s H:i').' | Usuário - '.$this->user->getName(). '|');
            $mpdf->WriteHTML($html);
            $mpdf->Output();

		}else {
			header("Location:" . BASE_URL);
			exit;
		}
	}

	public function veiculos(){
		$data = array();
		// informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if($this->user->hasPermission('report_veiculos')){
        	$this->loadTemplate('report_veiculos', $data);
        }else {
        	header("Location: ". BASE_URL);
        	exit();
        }		
	}

	public function veiculos_pdf(){
		if($this->user->hasPermission('report_veiculos')){
            $motorista = addslashes($_GET['veiculo_motorista']);
            $placa = addslashes($_GET['veiculo_placa']);            
            $empresa = addslashes($_GET['veiculo_empresa']);  
            $tipo = addslashes($_GET['tipo']);          
            $status = addslashes($_GET['status']);          
            $veiculo = new Veiculos();
            $data['veiculo_list'] = $veiculo->getVeiculoFiltrado($motorista,$placa,$empresa,$tipo,$status);
            $data['filters'] = $_GET;            
            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_veiculos_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html            
            ob_end_clean(); // zerando a memoria quanto a este processo
            $mpdf = new Mpdf();
            $mpdf->SetHeader('Portaria Ind Bandeirante| Relatório de Veículos Cadastrados |Pág. - {PAGENO}');
             $mpdf->SetFooter('Relatorio impresso :'.date('d/m/Y \à\s H:i').' | Usuário - '.$this->user->getName(). '|');
            $mpdf->WriteHTML($html);
            $mpdf->Output();


		}else {
			header("Location:" . BASE_URL);
			exit;
		}
	}

    public function entradaSaidaVeiculos(){
        $data = array();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if($this->user->hasPermission('report_entsaiveiculos')){
            $this->loadTemplate('report_entsaiveiculos', $data);
        }else {
            header("Location: ". BASE_URL);
            exit();
        }       
    }

    public function entsaiveiculos_pdf(){
        if($this->user->hasPermission('report_entsaiveiculos')){                
            $data1 = addslashes($_GET['ent_sai_data_inicial']);            
            $data2 = addslashes($_GET['ent_sai_data_final']);            
            $placa = addslashes(strtoupper($_GET['ent_sai_placa']));  
            $motorista = addslashes(strtoupper($_GET['ent_sai_motorista']));          
            $empresa = addslashes(strtoupper($_GET['ent_sai_empresa']));          
            $tipo = '2';
            $records = new Records(); 
            $data['records_list'] = $records->getEntradaSaida($data1,$data2,$placa,$motorista,$empresa,$tipo);                                    
            $data['filters'] = $_GET;            
            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_entsaiveiculos_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html            
            ob_end_clean(); // zerando a memoria quanto a este processo
            $mpdf = new Mpdf(['orientation' => 'L']);
            $mpdf->SetHeader('Portaria Ind Bandeirante| Relatório de Entrada e Saída Veículos |Pág. - {PAGENO}');
            $mpdf->SetFooter('Relatorio impresso : '.date('d/m/Y \à\s H:i').' | Usuário - '.$this->user->getName(). '|');
            $mpdf->WriteHTML($html);
            $mpdf->Output();

        }else {
            header("Location:" . BASE_URL);
            exit;
        }
    }


    public function recebimentoColeta(){
        $data = array();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if($this->user->hasPermission('report_recebcoleta')){
            $this->loadTemplate('report_recebcoleta', $data);
        }else {
            header("Location: ". BASE_URL);
            exit();
        }       
    }

    public function recebimentoColeta_pdf(){
        if($this->user->hasPermission('report_recebcoleta')){           
            $data1 = addslashes($_GET['receb_colet_data_inicial']);            
            $data2 = addslashes($_GET['receb_colet_data_final']);            
            $placa = addslashes(strtoupper($_GET['receb_colet_placa']));  
            $motorista = addslashes(strtoupper($_GET['receb_colet_motorista']));          
            $empresa = addslashes(strtoupper($_GET['receb_colet_empresa']));          
            $tipo = '1';
            $records = new Records(); 
            $data['records_list'] = $records->getRecebColet($data1,$data2,$placa,$motorista,$empresa,$tipo);                                    
            $data['filters'] = $_GET;            
            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_recebcoleta_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html            
            ob_end_clean(); // zerando a memoria quanto a este processo
            $mpdf = new Mpdf(['orientation' => 'L']);
            $mpdf->SetHeader('Portaria Ind Bandeirante| Relatório de Recebimento e Coleta de Materiais |Pág. - {PAGENO}');
             $mpdf->SetFooter('Relatorio impresso : '.date('d/m/Y \à\s H:i').' | Usuário - '.$this->user->getName(). '|');
            $mpdf->WriteHTML($html);
            $mpdf->Output();

        }else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

        public function controleChaves(){
        $data = array();
        // informações para o template
        $data['nome_usuario'] = $this->user->getName();
        $data['acesso'] = $this->user->getGroupName($this->user->getCpf());
        if($this->user->hasPermission('report_controlechaves')){
            $this->loadTemplate('report_controleChaves', $data);
        }else {
            header("Location: ". BASE_URL);
            exit();
        }       
    }

    public function controleChaves_pdf(){
        if($this->user->hasPermission('report_controlechaves')){           
            $data1 = addslashes($_GET['control_chaves_data_inicial']);            
            $data2 = addslashes($_GET['control_chaves_data_final']);            
            $local = addslashes(strtoupper($_GET['control_chaves_local']));            
            $tipo = '0';
            $records = new Records(); 
            $data['records_list'] = $records->getControleChaves($data1,$data2,$local,$tipo);                                    
            $data['filters'] = $_GET;            
            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_controleChaves_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html            
            ob_end_clean(); // zerando a memoria quanto a este processo
            $mpdf = new Mpdf(['orientation' => 'L']);
            $mpdf->SetHeader('Portaria Ind Bandeirante| Relatório de Entrada e Saída Veículos |Pág. - {PAGENO}');
             $mpdf->SetFooter('Relatorio impresso : '.date('d/m/Y \à\s H:i').' | Usuário - '.$this->user->getName(). '|');
            $mpdf->WriteHTML($html);
            $mpdf->Output();

        }else {
            header("Location:" . BASE_URL);
            exit;
        }
    }
}