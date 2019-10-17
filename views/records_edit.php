<style>
    h2 {color: #0652DD;}
</style>
<h1 align="center">Registros - Editar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>

<?php if(isset($records_info) && !empty($records_info) && $records_info['tipov'] == '0'):?>
<h2>COD. Chave - <span><?= $records_info['cod'];?></span></h2>
<h2>LOCAL. Chave - <span><?= $records_info['local'];?></span></h2>
<h2>COLABORADOR RETIROU - <span><?= $records_info['colab_ret'];?></span></h2>
<h2>DATA - <span><?php echo date('d/m/Y',strtotime($records_info['data_er'])). ' - '. $records_info['hora_er'];?></span></h2>
<form  method="post">
    <label for="">Data Devolução</label><br>
        <input type="hidden" value="<?php echo $records_info['tipo'] ?>" name="tipo">
        <input type="date" name="data_sr" id="data_sr"  value="<?= $records_info['data_sr'] ? $records_info['data_sr'] : date('Y-m-d');?>">        
        <br><br>
        <label for="">Horario Devolução</label>
        <input type="text" name="hora_sr" id="hora_sr" value="<?=  $records_info['hora_sr'] ? $records_info['hora_sr'] : '' ?>"><br><br>
        <label>Colaborador-Devolução</label>
        <input type="text" name="colab_dev" value="<?= $records_info['colab_dev'] ? $records_info['colab_dev'] : '' ?>"><br><br>
    <input type="submit" name="refresh" value="ATUALIZAR">
</form>
<?php endif; ?>

<?php if(isset($records_info) && !empty($records_info) && $records_info['tipov'] != '0'):?>
<h2>Data Entrada - <span><?php echo date('d/m/Y',strtotime($records_info['data_er'])). ' - '. $records_info['hora_er'];?></span></h2>
<h2>Nome Motorista - <span><?= !empty($records_info['motorista']) ? $records_info['motorista'] : $records_info['motorista_v'];?></span></h2>
<h2>Placa Veículo - <span><?= !empty($records_info['placa']) ? $records_info['placa'] : $records_info['placa_v'];?></span></h2>
<h2>Empresa- <span><?= !empty($records_info['empresa']) ? $records_info['empresa'] : $records_info['empresa_v'];?></span></h2>

<form  method="post">
    <label for="">Data</label><br>        
        <input type="date" name="data_sr" id="data_sr"  value="<?= $records_info['data_sr'] ? $records_info['data_sr'] : date('Y-m-d');?>">        
        <br><br>
        <label for="">Horario</label>
        <input type="text" name="hora_sr" id="hora_sr" value="<?=  $records_info['hora_sr'] ? $records_info['hora_sr'] : '' ?>"><br><br>        
        <label for="" id="reg">Observações</label>
            <textarea name="obs_reg" id="reg"><?=$records_info['obs'];?></textarea>
            <fieldset>
                <legend style="color: blue; font-size: 15px;"><strong>Saída-Empresa-Intervalo-Não Obrigátorio</strong></legend><br>
                <label for="">Saída:</label>
                <input type="text" name="hora_int_sai" id="hora_int_sai" value="<?= $records_info['hr_int_sai']? $records_info['hr_int_sai'] : ''?>"><br><br>
                <label for="">Entrada:</label>
                <input type="text" name="hora_int_en" id="hora_int_en" value="<?= $records_info['hr_int_en']? $records_info['hr_int_en'] : ''?>"><br><br>
            </fieldset><br><br>
        
    <input type="submit" name="refresh" value="ATUALIZAR">
    
</form>
<?php endif; ?>
 <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_records_add.js"></script>