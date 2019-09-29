<script src="https://www.google.com/recaptcha/api.js"></script>
<h2><?php echo $title; ?></h2>

<?php
if(isset($_SESSION['robotError']) and $_SESSION['robotError'] == True) {?>
	<div class="alert alert-warning">
<!--		--><?//=$robotMessage?>
	</div>
	<?php
} else if(isset($_SESSION['duplicateUserError']) and $_SESSION['duplicateUserError'] == True){?>
	<div class="alert alert-warning">
		<?=$duplicateUserMessage?>
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

<?php echo form_open('user/register'); ?>

<div class="form-group">
    <select name="id_perfil" autofocus class="form-control" title="Perfil">
    <?php foreach ($profiles as $profiles_item){
        echo '<option value='.$profiles_item['id'].'>'.$profiles_item['nome'].'</option>'.PHP_EOL;
    }?>
    </select>
</div>
<div class="form-group">
	<input type="email" class="form-control" name="email" placeholder="E-mail" title="E-mail">
</div>
<div class="form-group">
    <input type="input" class="form-control" name="nome" placeholder="Username" title="Username">
</div>
<div class="form-group">
    <input type="password" class="form-control" name="senha" placeholder="Senha" title="Senha">
</div>
<div class="form-group">
	<input type="password" class="form-control" name="senha_repetida" placeholder="Senha novamente" title="Senha novamente">
</div>
<div class="form-group">
<div class="g-recaptcha" data-sitekey="6LemdroUAAAAADqsn__gjmwuz7YtCowA-NqeEOJX"></div>
</div>
<input class="btn btn-primary" type="submit" name="submit" value="Cadastrar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
