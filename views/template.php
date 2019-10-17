<?php date_default_timezone_set('America/Sao_Paulo'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Portaria - Indústria Bandeirante de Plásticos></title>
        <link href="<?= BASE_URL ?>/assets/css/template.css" rel="stylesheet"/>
        <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript">
            var BASE_URL = "<?= BASE_URL ?>";
        </script>
        <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.mask.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.validate.min.js"></script>
    </head>
    <body>

        <div class="leftmenu">
           <div class="company_name">
                <img src="<?= BASE_URL ?>/assets/images/logo_branco.png" height="70" width="70">
            </div>
            <div class="menuarea">
                <ul>
                    <?php 
                    if(isset($viewData['acesso']['name'])){ 
                        switch($viewData['acesso']['name']){
                            case 'PORTARIA':
                                echo '
                                    <li class="menuHome">
                                        <a href="'.BASE_URL.'">Home</a>
                                    </li>
                                    <li class="menuRecords">
                                        <a href="'.BASE_URL.'/records">Registros</a>
                                    </li>
                                    <li class="menuVeiculos">
                                        <a href="'.BASE_URL.'/veiculos">Veículos</a>
                                    </li>
                                    <li class="menuReports">
                                        <a href="'.BASE_URL.'/reports">Relatórios</a>
                                    </li>';
                            break;
                            case 'COMPRAS':
                                echo '
                                    <li class="menuHome">
                                        <a href="'.BASE_URL.'">Home</a>
                                    </li>
                                    <li class="menuRecords">
                                        <a href="'.BASE_URL.'/records">Entrada-Saída</a>
                                    </li>
                                    <li class="menuReports">
                                        <a href="'.BASE_URL.'/reports">Relatórios</a>
                                    </li>'; 
                            break;
                            case 'DESENVOLVEDOR':
                                echo '
                                    <li class="menuHome">
                                        <a href="'.BASE_URL.'">Home</a>
                                    </li>
                                    <li class="menuPermission">
                                        <a href="'.BASE_URL.'/permissions">Permissões</a>
                                    </li>
                                    <li class="menuUsers">
                                        <a href="'.BASE_URL.'/users">Usuários</a>
                                    </li>
                                    <li class="menuRecords">
                                        <a href="'.BASE_URL.'/records">Registros</a>
                                    </li>
                                    <li class="menuVeiculos">
                                        <a href="'.BASE_URL.'/veiculos">Veículos</a>
                                    </li>
                                    <li class="menuChaves">
                                        <a href="'. BASE_URL .'/chaves">Chaves</a>
                                    </li>
                                    <li class="menuReports">
                                        <a href="'.BASE_URL.'/reports">Relatórios</a>
                                    </li>
                                ';
                            break;
                            default :
                                echo '
                                    <li class="menuHome">
                                        <a href="'. BASE_URL .'">Home</a>
                                    </li>
                                    <li class="menuPermission">
                                        <a href="'.BASE_URL.'/permissions">Permissões</a>
                                    </li>
                                    <li class="menuUsers">
                                        <a href="'.BASE_URL.'/users">Usuários</a>
                                    </li>
                                    <li class="menuRecords">
                                        <a href="'.BASE_URL.'/records">Registros</a>
                                    </li>
                                    <li class="menuVeiculos">
                                        <a href="'.BASE_URL.'/veiculos">Veículos</a>
                                    </li>
                                    <li class="menuChaves">
                                        <a href="'.BASE_URL.'/chaves">Chaves</a>
                                    </li>
                                    <li class="menuReports">
                                        <a href="'.BASE_URL.'/reports">Relatórios</a>
                                    </li>
                                ';

                        }
                    }
                    ?>
                    
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="top">
                <div class="top_right"><a href="<?= BASE_URL ?>/login/logout" style="background: #000; padding: 13px;">Sair</a></div>
                <div class="top_right"><strong><?= $viewData['nome_usuario']. ' - '.$viewData['acesso']['name'] ?></strong></div>
            </div>

            <div class="area">
                <?php $this->loadViewInTemplate($viewName, $viewData) ?>
            </div>
        </div>

    </body>
</html>