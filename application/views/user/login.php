<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('user/login'); ?>

<div class="form-group">
	<input type="input" name="username" value="" placeholder="Username">
</div>
<div class="form-group">
	<input type="password" name="password" value="" placeholder="Senha">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Entrar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
