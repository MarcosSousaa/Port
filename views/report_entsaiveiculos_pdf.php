<link href="<?= BASE_URL ?>/assets/css/report.css" rel="stylesheet"/>
 
<fieldset>
    <?php
    if (isset($filters['ent_sai_data_inicial']) && !empty($filters['ent_sai_data_inicial']) && ($filters['ent_sai_data_final']) && !empty($filters['ent_sai_data_final'])) {
        echo "Filtrado pela Data: " . date('d/m/Y',strtotime($filters['ent_sai_data_inicial'])) . " Até ".date('d/m/Y',strtotime($filters['ent_sai_data_final']))."<br>";
    }
   if (isset($filters['ent_sai_placa']) && !empty($filters['ent_sai_placa'])) {
        echo "Filtrado pelo nome placa do veículo: " . $filters['ent_sai_placa'] . "<br>";
    }
   if (isset($filters['ent_sai_motorista']) && !empty($filters['ent_sai_motorista'])) {
        echo "Filtrado pelo nome do motorista: " . $filters['ent_sai_motorista'] . "<br>";
    }
   if (isset($filters['ent_sai_empresa']) && !empty($filters['ent_sai_empresa'])) {
        echo "Filtrado pelo nome da empresa do veículo: " . $filters['ent_sai_empresa'] . "<br>";
    }
    ?>

</fieldset>
<br />

<table width="100%" class="table_report">
    <thead>
        <tr>
            <th>Visitante</th>
            <th>Entrada</th>                                          
            <th>Placa </th> 
            <th>Motorista</th>
            <th>RG</th>
            <th>Empresa</th>                               
            <th>Intervalo</th>
            <th>Saída</th>
            <th>Obs.</th>

        </tr>
    </thead>            
    <?php foreach ($records_list as $records_item): ?>
        <tbody>
            <tr>
                <td><?= $records_item['visitante'] == '1' ? "Sim" : "Não";?></td>
                <td><?= date('d/m/Y',strtotime($records_item['data_er'])). ' - '. substr($records_item['hora_er'], 0, -3)?></td>                
                <td><?= !empty($records_item['placa']) ? $records_item['placa'] : $records_item['placa_v']; ?></td>
                <td><?= !empty($records_item['motorista']) ? $records_item['motorista'] : $records_item['motorista_v']; ?></td>
                <td><?= !empty($records_item['rg']) ? $records_item['rg'] : "Funcionario";?></td>
                <td><?= !empty($records_item['empresa']) ? $records_item['empresa'] : $records_item['empresa_v'] ?></td>
                <td>
                    <?= !empty($records_item['hr_int_en']) ? $records_item['hr_int_sai']. " Até ". $records_item['hr_int_en'] : " Sem Intervalo" ?>
                    
                </td>   
                <td><?= !empty($records_item['data_sr']) ? date('d/m/Y',strtotime($records_item['data_sr'])). ' - '. substr($records_item['hora_sr'], 0, -3) : " Sem saída" ?>
                    
                </td>
                <td><?= $records_item['obs']?></td>
            </tr>
    <?php endforeach; ?>
        </tbody>
</table>

