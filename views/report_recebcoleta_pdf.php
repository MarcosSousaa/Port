<link href="<?= BASE_URL ?>/assets/css/report.css" rel="stylesheet"/>
 
<fieldset>
    <?php
    if (isset($filters['receb_colet_data_inicial']) && !empty($filters['receb_colet_data_inicial']) && ($filters['receb_colet_data_final']) && !empty($filters['receb_colet_data_final'])) {
        echo "Filtrado pela Data: " . date('d/m/Y',strtotime($filters['receb_colet_data_inicial'])) . " Até ".date('d/m/Y',strtotime($filters['receb_colet_data_final']))."<br>";
    }
   if (isset($filters['receb_colet_placa']) && !empty($filters['receb_colet_placa'])) {
        echo "Filtrado pelo nome placa do veículo: " . $filters['receb_colet_placa'] . "<br>";
    }
   if (isset($filters['receb_colet_motorista']) && !empty($filters['receb_colet_motorista'])) {
        echo "Filtrado pelo nome do motorista: " . $filters['receb_colet_motorista'] . "<br>";
    }
   if (isset($filters['receb_colet_empresa']) && !empty($filters['receb_colet_empresa'])) {
        echo "Filtrado pelo nome da empresa do veículo: " . $filters['receb_colet_empresa'] . "<br>";
    }
    ?>

</fieldset>
<br />

<table width="100%" class="table_report">
    <thead>
        <tr>
            <th>Entrada</th>                                          
            <th>Placa </th> 
            <th>Motorista</th>
            <th>RG</th>
            <th>Empresa</th>                               
            <th>Saída</th>
            <th>Obs.</th>                                            
        </tr>
    </thead>            
    <?php foreach ($records_list as $records_item): ?>
        <tbody>
            <tr>
                <td><?= date('d/m/Y',strtotime($records_item['data_er'])). ' - '. substr($records_item['hora_er'], 0, -3)?></td>                
                <td><?= $records_item['placa_v'] ?></td>
                <td><?= $records_item['motorista_v'] ?></td>
                <td><?= $records_item['rg'] ?></td>
                <td><?= $records_item['empresa_v'] ?></td>   
                <td><?= !empty($records_item['data_sr']) ? date('d/m/Y',strtotime($records_item['data_sr'])). ' - '. substr($records_item['hora_sr'], 0, -3) : " Sem saída" ?>
                    
                </td>
                <td><?= $records_item['obs'] ?></td>
            </tr>
    <?php endforeach; ?>
        </tbody>
</table>

