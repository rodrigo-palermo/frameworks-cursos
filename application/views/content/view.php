<h2><?php echo $title; ?></h2>
<a href="<?php echo base_url().'content/create'; ?>" class="btn btn-outline-primary" title="Adicionar"><i class="material-icons">add</i></a>
	<table class='table'>
    <thead>
        <tr>
            <th>id</th>
            <th>Conteudo</th>
            <th>Curso</th>
            <th>Descrição</th>
			<th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($content as $content_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$content_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$content_item['nome'].'</td>'.PHP_EOL;
		echo '<td>'.$content_item['curso_nome'].'</td>'.PHP_EOL;
        echo '<td>'.$content_item['descricao'].'</td>'.PHP_EOL;
        echo '<td><a href='.base_url().'content/create/'.$content_item['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'content/delete/'.$content_item['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>

<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
