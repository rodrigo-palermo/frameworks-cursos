<h2><?php echo $title; ?></h2>

<?php
if(isset($_SESSION['duplicateUserError']) and $_SESSION['duplicateUserError'] == True) {
	?>
	<div class="alert alert-warning">
		<?= $duplicateUserMessage ?>
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

<?php echo form_open('user/edit'); ?>

<div class="form-group">
    <select hidden name="id_perfil" autofocus class="form-control" title="Perfil">
    <?php foreach ($profiles as $profiles_item){
        echo '<option value='.$profiles_item['id'].'>'.$profiles_item['nome'].'</option>'.PHP_EOL;
    }?>
    </select>
</div>
<div disabled class="form-group">
	<!--<label for="title">E-mail</label>-->
<!--    <input type="email" class="form-control" name="email" placeholder="E-mail" title="E-mail" value="--><?//=isset($user)?$user['email']:'';?><!--">-->
</div>
<div class="form-group">
	<label for="title">Username</label>
	<input type="input" class="form-control" name="nome" placeholder="Username" title="Username" value="<?=$user['nome'];?>">
</div>
<div class="form-group">
<!--	<label for="title">Senha</label>-->
<!--    <input type="password" class="form-control" name="senha" placeholder="Senha" title="Senha" value="--><?//=isset($user)?$user['senha']:'';?><!--">-->
</div>
<div class="form-group">
<!--	<label for="title">Confirme a senha</label>-->
<!--    <input type="password" class="form-control" name="senha_repetida" placeholder="Senha novamente" title="Senha novamente">-->
</div>

<input type="hidden" name="hdnId" value="<?=$user['id'];?>">
<input class="btn btn-primary" type="submit" name="submit" value="Atualizar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
