<html>
    <head>
        <title>Cursos Online <?php echo ' :: '.$title; ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'favicon.ico';?>">
        <?php
        require_once __DIR__.'/headLinks.php';
        require_once __DIR__.'/autenticacao.php';
        ?>
    </head>
    <body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark flex-row flex-md-row bd-navbar">
            <!-- Brand -->
            <a class="navbar-brand mr-0 mr-md-2" href="<?php echo base_url();?>">CURSOS ONLINE</a>
			<!-- Toggler/collapsibe Button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Navbar links -->
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a id='navHome' class="nav-link active" href="<?=base_url();?>">Home</a>
					</li>
<!--					 Include navs for all pages and add HREF for all navs ons this header page-->
				</ul>
				<ul class="navbar-nav bd-navbar-nav ml-auto">
					<!--//ADMIN-->
					<?php
					if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == True && isset($_SESSION['usuario_perfil']) && $_SESSION['usuario_perfil'] == 'Administrador') {
						$navItemAdmin = '<li class="nav-item">' . PHP_EOL;
//						$navItemAdmin .= '<a class="nav-link" href="#">Administrador</a>' . PHP_EOL;
						$navItemAdmin .=  anchor(base_url(), $this->session->usuario_nome, 'class="btn btn-outline-info"') . PHP_EOL;
						$navItemAdmin .= '</li>' . PHP_EOL;
						print $navItemAdmin;
					}
					?>
					<!--//CONTA-->
					<?php
					if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true && isset($_SESSION['usuario_perfil']) && $_SESSION['usuario_perfil'] != 'Administrador') {
						$navItemAccount = '<li class="nav-item">' . PHP_EOL;
//						$navItemAccount .= '<a class="nav-link" href="#">Conta</a>' . PHP_EOL;
						$navItemAccount .=  anchor('user/account', $this->session->usuario_nome, 'class="btn btn-outline-info"') . PHP_EOL;
						$navItemAccount .= '</li>' . PHP_EOL;
						print $navItemAccount;
					}
					?>
					<!--//LOGIN-->
					<?php
					if (!isset($_SESSION['autenticado']) || (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == false)) {
						$navItemLogin = '<li class="nav-item ">' . PHP_EOL;
						//$navItemLogin .= '<button id="nav-btn-login" type="button" class="btn btn-outline-info" href="#">LOGIN</button>' . PHP_EOL;
						$navItemLogin .=  anchor('user/login', 'Entrar', 'class="btn btn-outline-info"') . PHP_EOL;
						$navItemLogin .= '</li>' . PHP_EOL;
						print $navItemLogin;
					}
					?>
					<!--//REGISTER-->
					<?php
					if (!isset($_SESSION['autenticado']) || (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == false)) {
						$navItemRegister = '<li class="nav-item ">' . PHP_EOL;
						$navItemRegister .=  anchor('user/register', 'Criar conta', 'class="btn btn-outline-success"') . PHP_EOL;
						$navItemRegister .= '</li>' . PHP_EOL;
						print $navItemRegister;
					}
					?>
					<!--//LOGOUT-->
					<?php
					if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true) {
						$navItemLogout = '<li class="nav-item">' . PHP_EOL;
						//$navItemLogout .= '<button id="nav-btn-logout" type="button" class="btn btn-outline-danger" href="#">SAIR</button>' . PHP_EOL;
						$navItemLogout .=  anchor('user/logout', 'Sair', 'class="btn btn-outline-danger"') . PHP_EOL;
						$navItemLogout .= '</li>' . PHP_EOL;
						print $navItemLogout;
						?>
						<?php
					}
					?>
				</ul>
			</div>


        </nav>
    </header>
    <main>
        <div class="flex-container">
			<div>
			<?php
			//Avoid 'Voltar' button to receive same url when reload/refresh the page
			if(isset($_SESSION['acao_atual']) && $_SESSION['acao_atual'] != current_url()) {
				$_SESSION['acao_origem'] = $_SESSION['acao_atual'];
			} else {
				$_SESSION['acao_atual'] = current_url();
			}
			//Enable CI Profiler in all pages
			//$this->output->enable_profiler(TRUE);
			?>
