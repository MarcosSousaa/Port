<h1>Veículos - Editar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <strong>Tipo</strong><br />
    <?php echo $veiculos_info['tipo']; ?><br /><br />
    

    <label for="motorista">Motorista</label>
    <input type="text" name="motorista" required="" value="<?php echo $veiculos_info['motorista'];?>"><br><br>

    <strong>Placa</strong><br />
    <input type="text" name="placa" value="<?php echo $veiculos_info['placa']; ?>">    
    <label for="empresa">Empresa</label>
    <input type="text" name="empresa" value="<?php echo $veiculos_info['empresa'];?>"><br><br>
    
    <label>Status do Veículo</label><br>
    
    <input type="radio" name="status" value="A" <?= ($veiculos_info['status'] == 'A') ? 'checked="checked"' : '' ?> />Ativo

    <input type="radio" name="status" value="I" <?= ($veiculos_info['status'] == 'I') ? 'checked="checked"' : '' ?> />Inativo
    <br><br>

    <input type="submit" value="Editar">

</form>