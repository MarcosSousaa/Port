<h1>Relatórios de Veiculos</h1>

<form onsubmit="return openPopup(this)">

    <div class="report-grid-4">
        Nome do Motorista:<br>
        <input type="text" name="veiculo_motorista">
    </div>

    <div class="report-grid-4">
        Placa do Veículo:<br>
        <input type="text" name="veiculo_placa">
    </div>

    <div class="report-grid-4">
        Nome da Empresa:<br>
        <input type="text" name="veiculo_empresa">
    </div>

    <div class="report-grid-4">
        Tipo:<br>
        <select name="tipo">
            <option value="" selected="">Selecione um tipo de veículo</option>
            <option value="CARRO">CARRO</option>
            <option value="CAMINHAO">CAMINHÃO</option>
            <option value="MOTO">MOTO</option>
        </select>
    </div>

    <div class="report-grid-4">
        Status:<br>
        <select name="status">
            <option value="A" selected>Ativo</option>
            <option value="I">Inativo</option>            
        </select>
    </div>

    <div style="clear: both"></div>

    <div style="text-align: center">
        <input type="submit" value="Gerar Relatório">
    </div>

</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_report_veiculos.js"></script>