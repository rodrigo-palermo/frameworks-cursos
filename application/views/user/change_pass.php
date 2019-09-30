<script src="https://www.google.com/recaptcha/api.js"></script>
<h2><?php echo $title; ?></h2>

<?php
if(isset($_SESSION['oldPasswordMismatchError']) and $_SESSION['oldPasswordMismatchError'] == True){?>
	<div class="alert alert-warning">
		<?=$oldPasswordMismatchMessage?>
	</div>
	<?php
} else if(isset($_SESSION['passwordMismatchError']) and $_SESSION['passwordMismatchError'] == True){?>
	<div class="alert alert-warning">
		<?=$passwordMismatchMessage?>
	</div>
	<?php
} else {
	echo validation_errors();
}
?>

<?php echo form_open('user/change_pass'); ?>
<div class="form-group">
	<input type="password" class="form-control" name="senha_atual_digitada" placeholder="Senha atual" title="Senha atual">
</div>
<div class="form-group">
    <input type="password" class="form-control" name="senha" placeholder="Nova senha" title="Nova senha">
</div>
<div class="form-group">
	<input type="password" class="form-control" name="senha_repetida" placeholder="Confirme a nova senha" title="Confirme a nova senha">
</div>
<div class="form-group">
<div class="g-recaptcha" data-sitekey="6LemdroUAAAAADqsn__gjmwuz7YtCowA-NqeEOJX"></div>
</div>
<input type="hidden" name="hdnId" value="<?=$user['id'];?>">
<input class="btn btn-primary" type="submit" name="submit" value="Confirmar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
