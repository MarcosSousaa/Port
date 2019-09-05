<h1>Relatórios de Controle Retirada-Devolução de Chaves</h1>

<form onsubmit="return openPopup(this)">

    <div class="report-grid-4">
        Data Inicial<br>
        <input type="date" name="control_chaves_data_inicial" value="<?php echo date("Y-m-d") ?>">
    </div>

    <div class="report-grid-4">
        Data Final<br>
        <input type="date" name="control_chaves_data_final" value="<?php echo date("Y-m-d") ?>">
    </div>

    <div class="report-grid-4">
       Local Chave<br>
        <input type="text" name="control_chaves_local" placeholder="Local da Chave">
    </div>
    <div style="clear: both;"></div>
    <div style="text-align: center">
        <input type="submit" value="Gerar Relatório">
    </div>

</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/script_report_controlechaves.js"></script>