<div class="login">
<h2>Login</h2>
<form id="formLogin" action=''> <!--method='post'/-->
	<div class="form-group">
		<label for="login"></label>
		<input type="text" class="form-control" id="login" name="login" placeholder="Usuário" required>
	</div>
	<div class="form-group">
		<label for="senha"></label>
		<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
	</div>
	<div class="form-group">
		<!-- Variáveis POST para identificar LOGIN -->
		<input type="text" name="submitEntrar" hidden>

		<input type="submit" class="btn btn-outline-primary" name="submitEntrar" value="Entrar">
<!--		<button type='button' class='btn btn-outline-success more-vert-margin'>Registrar</button>-->
	</div>
</form>
</div>

<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('user/create'); ?>

<div class="form-group">
	<label for="username">Username</label>
	<input type="input" name="username" value="">
	<label for="password">Senha</label>
	<input type="input" name="username" value="">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
