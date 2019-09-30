<h1>Gerenciador de Cursos Online</h1>
<h2>Administrador</h2>
<div style="max-width:600px;">
	<ul class="list-group">
		<h5 class="list-group-item-title">Itens de Usuários</h5>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Perfil</h6>
			<div class="btn-group">
				<?php echo anchor('profile/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('profile/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Usuários</h6>
			<div class="btn-group">
				<?php echo anchor('user/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('user/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
		<h5 class="list-group-item-title">Itens de cursos</h5>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Categorias</h6>
			<div class="btn-group">
				<?php echo anchor('category/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('category/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Cursos</h6>
			<div class="btn-group">
				<?php echo anchor('course/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('course/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Turmas</h6>
			<div class="btn-group">
				<?php echo anchor('class/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('class/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<h6>Conteúdos</h6>
			<div class="btn-group">
				<?php echo anchor('content/create','Cadastro','class="btn btn-outline-primary"')?>
				<?php echo anchor('content/view','Lista','class="btn btn-outline-primary"')?>
			</div>
		</li>
<!--		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">-->
<!--			<h6>Avaliação</h6>-->
<!--			<div class="btn-group">-->
<!--				--><?php //echo anchor('test/create','Cadastro','class="btn btn-outline-primary"')?>
<!--				--><?php //echo anchor('test/view','Lista','class="btn btn-outline-primary"')?>
<!--			</div>-->
<!--		</li>-->
<!--		<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">-->
<!--			<h6>Boletim</h6>-->
<!--			<div class="btn-group">-->
<!--				--><?php //echo anchor('report/create','Cadastro','class="btn btn-outline-primary"')?>
<!--				--><?php //echo anchor('report/view','Lista','class="btn btn-outline-primary"')?>
<!--			</div>-->
<!--		</li>-->
	</ul>
</div>


