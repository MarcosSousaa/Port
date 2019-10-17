<h1>Chaves</h1>

<a class="button" href="<?= BASE_URL ?>/chaves/add">Adicionar Chaves</a>

<table width="100%">
    <tr>        
        <th>Codígo da Chave</th>        
        <th>Local Chave</th>        
        <th>Status da Chave</th>
        <th width="180">Ações</th>
    </tr>
    <?php foreach ($chaves_list as $c): ?>
        <tr>            
            <td><?= $c['cod'] ?></td>
            <td><?= $c['local'] ?></td>
            <td><?= ($c['status'] == 'A'? 'Ativo' : 'Inativo'); ?></td>            
            <td>
                <a class="button button_small" href="<?= BASE_URL ?>/chaves/view/<?= $c['id'] ?>">Visualizar</a>
                <a class="button button_small" href="<?= BASE_URL ?>/chaves/edit/<?= $c['id'] ?>">Editar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $p_count; $i++): ?>
        <div class="pag_item <?= ($i == $p) ? 'pag_ativo' : '' ?>"><a href="<?= BASE_URL ?>/chaves?p=<?= $i ?>"><?= $i ?></a></div>
    <?php endfor; ?>
    <div style="clear: both"></div>
</div>

<!--<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_veiculos.js"></script> -->
