<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('profile/create'); ?>

<div class="form-group">
    <label for="nome">Nome</label>
    <input type="input" name="nome">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Cadastrar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
<li><?php echo anchor('profile/view','Lista')?></li>
</form>
