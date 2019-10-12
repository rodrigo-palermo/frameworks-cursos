<h5 class="list-group-item-title">Cursos inscritos</h5>
<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
	<h6>Cursos</h6>
	<div class="btn-group">
	<?php echo anchor('course/search','Procurar','class="btn btn-outline-primary" disabled');?>
	</div>
</li>
<table class='table'>
    <thead>
        <tr>
            <th>id</th>
            <th>Curso</th>
            <th>Professor</th>
			<th>Categoria</th>
            <th>Descrição</th>
			<th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($course as $course_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$course_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$course_item['nome'].'</td>'.PHP_EOL;
		echo '<td>'.$course_item['usuario_nome'].'</td>'.PHP_EOL;
		echo '<td>'.$course_item['categoria_nome'].'</td>'.PHP_EOL;
        echo '<td>'.$course_item['descricao'].'</td>'.PHP_EOL;
        echo '<td><a href='.base_url().'course/create/'.$course_item['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'course/delete/'.$course_item['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>
