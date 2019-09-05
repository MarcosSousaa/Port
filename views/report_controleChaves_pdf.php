<link href="<?= BASE_URL ?>/assets/css/report.css" rel="stylesheet"/>
 
<fieldset>
    <?php
    if (isset($filters['control_chaves_data_inicial']) && !empty($filters['control_chaves_data_inicial']) && ($filters['control_chaves_data_final']) && !empty($filters['control_chaves_data_final'])) {
        echo "Filtrado pela Data: " . date('d/m/Y',strtotime($filters['control_chaves_data_inicial'])) . " Até ".date('d/m/Y',strtotime($filters['control_chaves_data_final']))."<br>";
    }
   if (isset($filters['control_chaves_local']) && !empty($filters['control_chaves_local'])) {
        echo "Filtrado pelo nome do Local da Chave: " . $filters['control_chaves_local'] . "<br>";
    }
    ?>

</fieldset>
<br />

<table width="100%" class="table_report">
    <thead>
        <tr>
            <th>Data-Retirada</th>                                          
            <th>Colab-Retirou</th> 
            <th>Chave</th>
            <th>Local</th>                               
            <th>Data-Devolução</th>                                            
            <th>Colab-Devolveu</th>            
        </tr>
    </thead>            
    <?php foreach ($records_list as $records_item): ?>
        <tbody>
            <tr>
                <td><?= date('d/m/Y',strtotime($records_item['data_er'])). ' - '. substr($records_item['hora_er'], 0, -3)?></td>                
                <td><?= $records_item['colab_ret'] ?></td>
                <td><?= $records_item['cod'] ?></td>
                <td><?= $records_item['local'] ?></td>   
                <td><?= !empty($records_item['data_sr']) ? date('d/m/Y',strtotime($records_item['data_sr'])). ' - '. substr($records_item['hora_sr'], 0, -3) : " Sem saída" ?></td>
                <td><?= $records_item['colab_dev'] ?></td>                
            </tr>
    <?php endforeach; ?>
        </tbody>
</table>

