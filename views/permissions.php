<h1>Permissões</h1>

<div class="tabarea">
    <div class="tabitem activetab">Grupos de permissões</div>
    <?php if($permissions_add) : ?>
    <div class="tabitem">Permissões</div>
    <?php endif ?>
</div>

<div class="tabcontent">
    <div class="tabbody">
        <?php if($permissions_addgroup) : ?>
        <a class="button" href="<?= BASE_URL ?>/permissions/add_group">Adicionar Grupo de Permissão</a>
        <?php endif; ?>
        <table width="100%">
            <tr>
                <th>Nome do Grupo de Permissões</th>
                <th width="160">Ações</th>
            </tr>
            <?php foreach ($permission_groups_list as $p): ?>
                <tr>
                    <td><?= $p['name'] ?></td>
                    <td>
                        <a class="button button_small" href="<?= BASE_URL ?>/permissions/edit_group/<?= $p['id'] ?>">Editar</a>
                        <a class="button button_small" href="<?= BASE_URL ?>/permissions/delete_group/<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php if($permissions_add) { ?>
    <div class="tabbody">
        <?php if($permissions_del) : ?>
        <a class="button" href="<?= BASE_URL ?>/permissions/add">Adicionar Permissão</a>
        <?php endif; ?>
        <table width="100%">
            <tr>
                <th>Nome da Permissão</th>
                <?php if($permissions_del) : ?>
                <th width="50">Ações</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($permission_list as $p): ?>
                <tr>
                    <td><?= $p['name'] ?></td>
                    <?php if($permissions_del) : ?>
                    <td>
                        <a class="button button_small" href="<?= BASE_URL ?>/permissions/delete/<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php }?>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_permissions.js"></script>