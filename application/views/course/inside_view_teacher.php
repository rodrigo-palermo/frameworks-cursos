<h5 class="list-group-item-title">Cursos</h5>
<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
	<h6>Cursos</h6>
	<div class="btn-group">
	<?php echo anchor('course/create','Adicionar','class="btn btn-outline-primary" disabled');?>
	</div>
</li>
<table class='table'>
    <thead>
        <tr>
<!--            <th>id</th>-->
            <th>Curso</th>
<!--            <th>Professor</th>-->
			<th>Categoria</th>
            <th>Descrição</th>
			<th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($course as $course_item) {
        echo '<tr>'.PHP_EOL;
//        echo '<td>'.$course_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$course_item['nome'].'</td>'.PHP_EOL;
//		echo '<td>'.$course_item['usuario_nome'].'</td>'.PHP_EOL;
		echo '<td>'.$course_item['categoria_nome'].'</td>'.PHP_EOL;
        echo '<td>'.$course_item['descricao'].'</td>'.PHP_EOL;
        echo '<td class="text-right"><a href='.base_url().'course/create/'.$course_item['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'course/delete/'.$course_item['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
        echo '</tr>'.PHP_EOL;
//		foreach($content as $content_item) {
//			if ($content_item['id_curso'] == $course_item['id']){
//				echo '<tr><td>teste</td></tr>';
//			}
//		}
		echo '<tr><td></td><td colspan="3">'.PHP_EOL;
		?>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Conteúdo</h6>
			<div class="btn-group">
				<?php echo anchor('content/create','Adicionar','class="btn btn-outline-primary btn-sm" disabled');?>
			</div>
		</li>
		<table class='table table-sm'>
<!--			<thead>-->
<!--			<tr>-->
<!--				            <th>id</th>-->
<!--				<th>Conteúdo</th>-->
<!--				           <th>Curso</th>-->
<!--				           <th>Descrição</th>-->
<!--				<th>Ações</th>-->
<!--			</tr>-->
<!--			</thead>-->
			<tbody>
			<?php foreach($content as $content_item) {
			if ($content_item['id_curso'] == $course_item['id']) {
				echo '<tr>' . PHP_EOL;
//        echo '<td>'.$content_item['id'].'</td>'.PHP_EOL;
				echo '<td class="align-middle text-left">' . $content_item['nome'] . '</td>' . PHP_EOL;
//		echo '<td>'.$content_item['curso_nome'].'</td>'.PHP_EOL;
//        echo '<td>'.$content_item['descricao'].'</td>'.PHP_EOL;
				echo '<td class="align-middle text-right"><a href=' . base_url() . 'content/create/' . $content_item['id'] . ' class="btn btn-outline-primary btn-sm transp" title="Editar"><i class="material-icons md-18">edit</i></a>
				  <a href=' . base_url() . 'content/delete/' . $content_item['id'] . ' class="btn btn-outline-danger btn-sm transp" title="Excluir"><i class="material-icons md-18">delete</i></a></td>
        	      ' . PHP_EOL;
				echo '</tr>' . PHP_EOL;
			}}?>
			</tbody>
		</table>


		<?php
		echo '</td></tr>'.PHP_EOL;
    }?>
    </tbody>
</table>
