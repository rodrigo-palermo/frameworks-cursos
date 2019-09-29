<h2><?php echo $title; ?></h2>

<?php
if(isset($_SESSION['loginError']) and $_SESSION['loginError'] == True){?>
<div class="alert alert-warning">
	<?=$errorMessage?>
</div>
<?php
} else {
	echo validation_errors();
}
?>



<?php echo form_open('user/login'); ?>

<div class="form-group">
	<input type="input" class="form-control" name="nome" value="" placeholder="Username" title="Username">
</div>
<div class="form-group">
	<input type="password" class="form-control" name="senha" value="" placeholder="Senha" title="Senha">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Entrar">
<a href="<?php echo base_url().'user/reset_pass/';?>." class="btn btn-secondary">Redefinir senha</a>
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
