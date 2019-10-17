<h1>Veiculos</h1>

<a class="button" href="<?= BASE_URL ?>/veiculos/add">Adicionar Veículo</a>

<table width="100%">
    <tr>        
        <th>Tipo</th>
        <th>Motorista</th>
        <th>Placa</th>    
        <th>Status</th>                
        <th width="180">Ações</th>
    </tr>
    <?php foreach ($veiculos_list as $v): ?>
        <tr>
            <td><?= $v['tipo'] ?></td>
            <td><?= $v['motorista'] ?></td>
            <td><?= $v['placa'] ?></td>
            <td><?= ($v['status'] == 'A'? 'Ativo' : 'Inativo'); ?></td>      
            <td>
                <a class="button button_small" href="<?= BASE_URL ?>/veiculos/view/<?= $v['id'] ?>">Visualizar</a>
                <a class="button button_small" href="<?= BASE_URL ?>/veiculos/edit/<?= $v['id'] ?>">Editar</a>                
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $p_count; $i++): ?>
        <div class="pag_item <?= ($i == $p) ? 'pag_ativo' : '' ?>"><a href="<?= BASE_URL ?>/veiculos?p=<?= $i ?>"><?= $i ?></a></div>
    <?php endfor; ?>
    <div style="clear: both"></div>
</div>
