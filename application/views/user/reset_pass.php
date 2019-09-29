<h2><?php echo $title; ?></h2>

<?php
if(isset($_SESSION['emailError']) and $_SESSION['emailError'] == True){?>
<div class="alert alert-warning">
	<?=$emailErrorMessage?>
</div>
<?php
} else {
	echo validation_errors();
}
?>

<?php echo form_open('user/reset_pass'); ?>
<div class="form-group">
	<h6>Informe seu e-mail cadastrado para gerar uma senha provisória</h6>
</div>
<div class="form-group">
	<input type="email" class="form-control" name="email" value="" placeholder="E-mail" title="E-mail">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Enviar e-mail">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
