<h1>Relatórios de Recebimento e Coleta</h1>

<form onsubmit="return openPopup(this)">

    <div class="report-grid-4">
        Data Inicial<br>
        <input type="date" name="receb_colet_data_inicial" value="<?php echo date("Y-m-d") ?>">
    </div>

    <div class="report-grid-4">
        Data Final<br>
        <input type="date" name="receb_colet_data_final" value="<?php echo date("Y-m-d") ?>">
    </div>

    <div class="report-grid-4">
       Placa<br>
        <input type="text" name="receb_colet_placa" placeholder="Informe algo que contem a placa">
    </div>

    <div class="report-grid-4">
       Nome<br>
        <input type="text" name="receb_colet_motorista" placeholder="Nome do Motorista">
    </div>

    <div class="report-grid-4">
       Empresa<br>
        <input type="text" name="receb_colet_empresa" placeholder="Empresa Padrão IND BANDEIRANTE">
    </div>

    <div style="clear: both"></div>

    <div style="text-align: center">
        <input type="submit" value="Gerar Relatório">
    </div>

</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_report_recebcoleta.js"></script>