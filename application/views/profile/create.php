<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('profile/create'); ?>

<div class="form-group">
<!--    <label for="nome">Nome</label>-->
    <input type="input" class="form-control"  name="nome" placeholder="Perfil" value="<?=isset($profile)?$profile['nome']:'';?>">
</div>

<input type="hidden" name="hdnId" value="<?=isset($profile)?$profile['id']:'';?>">
<input class="btn btn-primary" type="submit" name="submit" value="<?=isset($profile)?'Atualizar':'Cadastrar';?>">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
