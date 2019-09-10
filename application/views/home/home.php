<h1>Gerenciador de Cursos Online</h1>
<h2>Visão geral</h2>

<ul>
    <li>Usuários</li>
    <ol>
		<li><?php echo anchor('user/create','Cadastro')?></li>
		<li><?php echo anchor('user/view','Lista')?></li>
    </ol>
    
    <li>Perfil de Usuários</li>
    <ol>
		<li><?php echo anchor('profile/create','Cadastro')?></li>
		<li><?php echo anchor('profile/view','Lista')?></li>
    </ol>

    <li>Itens de cursos</li>
    <ol>
        <li>Curso</li>
        <li>Tópico</li>
        <li>Atividade</li>
        <li>Avaliação</li>
        <li>Boletim</li>
    </ol>
</ul>


