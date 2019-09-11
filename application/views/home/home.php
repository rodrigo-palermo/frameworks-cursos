<h1>Gerenciador de Cursos Online</h1>
<h2>Visão geral</h2>

<ul class="list-group">
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
		<h4>Usuários</h4>
    <div class="btn-group">
		<button type="button" class="btn btn-outline-primary"><?php echo anchor('user/create','Cadastro')?></button>
		<button type="button" class="btn btn-outline-primary"><?php echo anchor('user/view','Lista')?></button>
    </div>
	</li>
    
    <li class="list-group-item">Perfil de Usuários</li>
    <ol>
		<li><?php echo anchor('profile/create','Cadastro')?></li>
		<li><?php echo anchor('profile/view','Lista')?></li>
    </ol>

    <li class="list-group-item">Itens de cursos</li>
    <ol>
        <li>Categoria</li>
        <li>Curso</li>
        <li>Tópico</li>
        <li>Atividade</li>
        <li>Avaliação</li>
        <li>Boletim</li>
    </ol>
</ul>


