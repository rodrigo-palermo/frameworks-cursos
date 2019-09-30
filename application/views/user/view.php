<h2><?php echo $title; ?></h2>
<a href="<?php echo base_url().'user/create'; ?>" class="btn btn-outline-primary" title="Adicionar"><i class="material-icons">person_add</i></a>
<table class='table'>
    <thead>
        <tr>
            <th>Nome</td>
            <th>Perfil</td>
            <th>e-mail</td>
            <th>Data de cadastro</td>
            <th>Ações</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($users as $users_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$users_item['nome'].'</td>'.PHP_EOL;
        echo '<td>'.$users_item['perfil_nome'].'</td>'.PHP_EOL;
        echo '<td>'.$users_item['email'].'</td>'.PHP_EOL;
        echo '<td>'.$users_item['dth_inscricao'].'</td>'.PHP_EOL;
		echo '<td><a href='.base_url().'user/edit/'.$users_item['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'user/delete/'.$users_item['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>

<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
