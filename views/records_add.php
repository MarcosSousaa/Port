<h1>Registros - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<h2 id="titulo-registro"></h2>
 <form method="post">
    <br /><br />
    <label for="tipoReg">Tipo Registro</label>
    <select class="form-control" id="tipoReg" name="tipo">
        <option disabled selected>Escolha uma opção</option>
        <option value="0">Retirada - Chaves</option>
        <option value="1">Entrega / Recebimento</option>
        <option value="2">Entrada - Veículo</option>
    </select>           
    <section class="padrao">        
        <label for="">Data</label><br>
        <input type="date" name="data_er" id="data_er" value="<?php echo date('Y-m-d');?>">        
        <br>
        <label for="">Horario</label>
        <input type="text" name="hora_er" id="hora_er">     
    </section>                              
    <br /><br />
    <div>       
        <section id="tipoChaves">
            <div class="form-group col-md-3">
                <label for="chaves">Chaves</label>
                <select class="form-control" id="chaves"></select>
                <span class="errorMsgChave"></span>   
            </div>
            <div class="form-group col-md-3">
                <label for="colab_ret">Colaborador Retira</label>
                <input type="text"  id="colab_ret" class="form-control">
                <span class="errorMsgColab"></span>
            </div>          
        </section>
        <section id="tipoServico">
            <label>Visitante</label>
            <select class="form-control" id="visitante" name="visitante">
                <option disabled selected>Visitante</option>
                <option value="1">Sim</option>
                <option value="0" selected="">Não</option>                
            </select>          
            <div class="form-group col-md-3">
                <label for="chaves">Placa</label>
                <input type="text" id="placa-reg" placeholder="informe a placa" class="form-control placa" name="">
                <span class="errorMsgPlaca"></span>
                <input type="hidden" id="ukVeiculo">
            </div>
            <div class="form-group col-md-3 nme">
                <label for="chaves">Nome Motorista</label>
                <input type="text" id="nome-reg" class="form-control" disabled>
                <span class="errorMsgMot"></span>
            </div> 
            <div class="form-group col-md-3">
                <label for="">RG Motorista</label>
                <input type="text"  id="rg-entrada" name="rg-entrada" disabled class="form-control">
                <span class="errorMsgRG"></span>
            </div>                   
            <div class="form-group col-md-3">
                <label for="chaves">Empresa Motorista</label>
                <input type="text" id="empresa-reg" class="form-control" disabled>
                <span class="errorMsgEmp"></span>
            </div>            
        </section>
        <section id="tipoRecebimento">
            <div class="form-group col-md-7">
                <label for="tipo">Tipo Veículo</label>
                <select class="form-control" id="tipo_vr">
                    <option disabled selected>Escolha uma opção</option>
                    <option value="CAMINHAO">Caminhão</option>
                    <option value="CARRO">Carro</option>
                    <option value="MOTO">Moto</option>
                </select>
                <span class="errorMsgTipo"></span>           
            </div>
            <div class="form-group col-md-2">
                <label for="">Placa Veículo</label>
                <input type="text"  id="placa_r"  class="form-control placa">
                <span class="errorMsgPlacaReceb"></span>
            </div>      
            
            <div class="form-group col-md-3">
                <label for="">Nome Motorista</label>
                <input type="text"  id="nome_reg" class="form-control">
                <span class="errorMsgMotReceb"></span>
            </div>          
            <div class="form-group col-md-3">
                <label for="">RG Motorista</label>
                <input type="text"  id="reg"  name="rg" class="form-control">
                <span class="errorMsgRGReceb"></span>
            </div>          
            <div class="form-group col-md-3">
                <label for="">Empresa Motorista</label>
                <input type="text"   id="empresa_reg" class="form-control">
                <span class="errorMsgEmpReceb"></span>
            </div>              
        </section>       
    </div>
    <div class="form-group col-md-3">
        <label for="" id="lbl_reg">Observações</label>
        <textarea  name="obs_reg"  id="obs_reg" style="text-align:left;"></textarea>
        <span class="errorMsgObs"></span>
    </div>                          
    <div class="alert alert-danger" id="msg-veiculos" role="alert">
        <a href="#janela1" id="modal" rel="modal">CLIQUE AQUI</a>>
    </div>                  
    <br /><br />
    <input type="button" value="Adicionar" id="addRegistro" />
                            
 </form> 
<div class="window" id="janela1">
    <a href="#" class="close"> X </a>    
        <h2><span class="msgTitle"></span> - CADASTRAR VEICULO</h2>
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo">
            <option value="CARRO">Carro</option>
            <option value="MOTO">Moto</option>            
        </select>
        <br /><span class="errorMsgTipoCad"></span><br />

        <label for="motorista">Motorista</label>
        <input type="text" name="motorista"  placeholder="INFORME O NOME DO MOTORISTA"><br><span class="errorMsgMotCad"></span><br>
        

        <label for="placa">Placa</label>
        <input type="text" name="placa_c"  placeholder="INFORME A PLACA DO VEICULO">
        <br><span class="errorMsgPlacaCad"></span><br>

        <label for="empresa">Empresa</label>
        <input type="text" name="empresa"  placeholder="INFORMA O NOME DA EMPRESA">
        <br><span class="errorMsgEmpCad"></span><br>
        <button class="btn" id="adcVeiculo" data-type="cadVeiculos">Adicionar</button>              
</div>    
<div id="mascara"></div>


<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_records_add.js"></script>