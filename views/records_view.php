<h1>Registros - Visualizar</h1>

<?php if(isset($records_info) && !empty($records_info) && $records_info['tipov'] == '0'):?>
    <h4>CHAVES</h4>

    <label for="">Data-Retirada</label><br>        
    <input type="text" value="<?php echo date('d/m/Y', strtotime($records_info['data_er'])). ' - '.$records_info['hora_er'];?>" disabled><br><br>        
    <label>Colaborador-Retirou</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['colab_ret'];?>" disabled><br><br>
    <label>Codígo-Chave</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['cod'];?>" disabled><br><br>
    <label>Local-Chave</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['local'];?>" disabled><br><br>
    <label for="">Data-Devolução</label><br>        
    <input type="text" value="<?= !empty($records_info['data_sr']) ? date('d/m/Y', strtotime($records_info['data_sr'])). ' - '.$records_info['hora_sr'] : 'Sem Devolução'?>" disabled><br><br>             
    <label>Colaborador-Devolveu</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['colab_dev'];?>" disabled><br><br>
    <a class="button button_small" href="<?= BASE_URL?>/records">VOLTAR</a>
<?php endif; ?>

<?php if(isset($records_info) && !empty($records_info) && $records_info['tipov'] == '1'):?>
    <h4>ENTREGA-RECEBIMENTO</h4>
    <label for="">Data-Entrada</label><br>        
    <input type="text" value="<?php echo date('d/m/Y', strtotime($records_info['data_er'])). ' - '.$records_info['hora_er'];?>" disabled><br><br>        
    <label>Tipo Veículo</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['tipo_v'];?>" disabled><br><br>
    <label>Placa</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['placa_v'];?>" disabled><br><br>
     <label>RG Motorista</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['rg'];?>" disabled><br><br>
    <label>Motorista</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['motorista_v'];?>" disabled><br><br>
     <label>Empresa</label>
    <input type="text" name="colab_dev" value="<?php echo $records_info['empresa_v'];?>" disabled><br><br>
    <label for="">Data-Saída</label><br>        
    <input type="text" value="<?= !empty($records_info['data_sr']) ? date('d/m/Y', strtotime($records_info['data_sr'])). ' - '.$records_info['hora_sr'] : 'Sem Saída'?>" disabled><br><br>        
    
    <a class="button button_small" href="<?= BASE_URL?>/records">VOLTAR</a>
<?php endif; ?>

<?php if(isset($records_info) && !empty($records_info) && $records_info['tipov'] == '2'):?>
    <h4>ENTRADA VEÍCULOS</h4>
    <label for="">Data-Entrada</label><br>        
    <input type="text" value="<?php echo date('d/m/Y', strtotime($records_info['data_er'])). ' - '.$records_info['hora_er'];?>" disabled><br><br>    
    <label>Placa</label>
    <input type="text" name="colab_dev" value="<?= !empty($records_info['placa']) ? $records_info['placa'] : $records_info['placa_v'];?>" disabled><br><br>
    <label>Motorista</label>
    <input type="text" name="colab_dev" value="<?= $records_info['motorista'] ? $records_info['motorista'] : $records_info['motorista_v'];?>" disabled><br><br>
     <label>Empresa</label>
    <input type="text" name="colab_dev" value="<?= !empty($records_info['empresa']) ? $records_info['empresa'] : $records_info['empresa_v'];?>" disabled><br><br>
    <fieldset>
        <legend style="color: blue; font-size: 15px;">
            <strong>Saída-Empresa-Intervalo</strong>
        </legend><br>
        <label for="">Saída</label><br>        
    <input type="text" value="<?= !empty($records_info['hr_int_sai']) ? date('d/m/Y', strtotime($records_info['data_er'])). ' - '.$records_info['hr_int_sai'] : 'Sem saída para Intervalo'?>" disabled><br><br>
    <label for="">Entrada</label><br>        
    <input type="text" value="<?= !empty($records_info['hr_int_en']) ? date('d/m/Y', strtotime($records_info['data_er'])). ' - '.$records_info['hr_int_en'] : 'Sem saída para Intervalo'?>" disabled><br><br>

    </fieldset>   
    <label for="">Data-Saída</label><br>        
    <input type="text" value="<?= !empty($records_info['data_sr']) ? date('d/m/Y', strtotime($records_info['data_sr'])). ' - '.$records_info['hora_sr'] : 'Sem Saída'?>" disabled><br><br>
    <label>Observação</label>        
    <textarea disabled><?= $records_info['obs'] ?></textarea>
    <a class="button button_small" href="<?= BASE_URL?>/records">VOLTAR</a>
<?php endif; ?>

 <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_records_add.js"></script>