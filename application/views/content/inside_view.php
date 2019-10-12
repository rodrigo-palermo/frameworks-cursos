<!--<h5 class="list-group-item-title">Conteúdos</h5>-->
<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
	<h6>Conteúdo</h6>
	<div class="btn-group">
		<?php echo anchor('content/create','Adicionar','class="btn btn-outline-primary" disabled');?>
	</div>
</li>
<table class='table'>
    <thead>
        <tr>
<!--            <th>id</th>-->
            <th>Conteúdo</th>
<!--            <th>Curso</th>-->
<!--            <th>Descrição</th>-->
			<th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($content as $content_item) {
        echo '<tr>'.PHP_EOL;
//        echo '<td>'.$content_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$content_item['nome'].'</td>'.PHP_EOL;
//		echo '<td>'.$content_item['curso_nome'].'</td>'.PHP_EOL;
//        echo '<td>'.$content_item['descricao'].'</td>'.PHP_EOL;
        echo '<td><a href='.base_url().'content/create/'.$content_item['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'content/delete/'.$content_item['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>
