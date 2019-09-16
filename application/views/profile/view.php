<h2><?php echo $title; ?></h2>
<a href="<?php echo base_url().'profile/create'; ?>" class="btn btn-outline-primary" title="Adicionar">+</a>
	<table class='table'>
    <thead>
        <tr>
            <th>id</th>
            <th>Perfil</th>
			<th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($profiles as $profile_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$profile_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$profile_item['nome'].'</td>'.PHP_EOL;
        echo "<td><a href=".base_url()."profile/delete/".$profile_item['id']." class='btn btn-outline-danger' title='Excluir'>Excluir</a>
        	      <a href=".base_url()."profile/create/".$profile_item['id']." class='btn btn-outline-primary' title='Editar'>Editar</a>
              </td>".PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>

<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
