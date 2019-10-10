<h2><?php echo $title; ?></h2>

<div style="max-width:600px;">
	<ul class="list-group">
		<h5 class="list-group-item-title">Perfil</h5>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Informações Pessoais</h6>
		</li>
		<table class='table'>
			<thead>
			<tr>
				<th>Nome</td>
				<th>Perfil</td>
				<th>e-mail</td>
				<th>Imagem</td>
<!--				<th>Data de cadastro</td>-->
				<th>Ações</td>
			</tr>
			</thead>
			<tbody>
			<?php	echo '<tr>'.PHP_EOL;
				echo '<td>'.$user['nome'].'</td>'.PHP_EOL;
				echo '<td>'.$user['perfil_nome'].'</td>'.PHP_EOL;
				echo '<td>'.$user['email'].'</td>'.PHP_EOL;
				echo '<td>'.$user['imagem'].'</td>'.PHP_EOL;
//				echo '<td>'.$user['dth_inscricao'].'</td>'.PHP_EOL;
				echo '<td><a href='.base_url().'user/edit/'.$user['id'].' class="btn btn-outline-primary" title="Editar"><i class="material-icons">edit</i></a>
				  <a href='.base_url().'user/delete/'.$user['id'].' class="btn btn-outline-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
        	      '.PHP_EOL;
				echo '</tr>'.PHP_EOL;
			?>
			</tbody>
		</table>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Senha</h6>
			<div class="btn-group">
				<?php echo anchor('user/change_pass/'.$user['id'],'Alterar senha','class="btn btn-outline-primary"')?>
			</div>
		</li>

		<h5 class="list-group-item-title">Cursos</h5>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Cursos</h6>
			<div class="btn-group">
				<?php if($this->session->usuario_perfil == 'Professor')
								echo anchor('course/create','Adicionar','class="btn btn-outline-primary" disabled');
				           else
							   echo anchor('course/search','Procurar','class="btn btn-outline-primary" disabled');
				?>
			</div>
		</li>
		<div><?php echo $course_view;?></div>
	</ul>
</div>


