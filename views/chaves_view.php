<h1>Chaves - Visualizar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="cod">Cod. Interno da Chave</label><br>
    <input type="text" name="cod" disabled value="<?php echo $chaves_info['cod'];?>"><br /><br />

    <label for="local">Local da Chave</label>
    <input type="text" name="local" disabled value="<?php echo $chaves_info['local'];?>"><br><br>

    <label>Status da Chave</label><br>
    
    <input type="radio" name="status" disabled value="A" <?= ($chaves_info['status'] == 'A') ? 'checked="checked"' : '' ?> />Ativo

    <input type="radio" name="status" disabled value="I" <?= ($chaves_info['status'] == 'I') ? 'checked="checked"' : '' ?> />Inativo
    <br><br>

    <a class="button button_small" href="<?= BASE_URL?>/chaves">VOLTAR</a>

</form>