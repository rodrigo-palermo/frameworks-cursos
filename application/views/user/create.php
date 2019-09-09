<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('user/create'); ?>

<div class="form-group">
    <label for="id_perfil">Perfil</label>
    <select name="id_perfil" autofocus>
    <?php foreach ($profiles as $profiles_item){
        echo '<option value='.$profiles_item['id'].'>'.$profiles_item['nome'].'</option>'.PHP_EOL;
    }?>
    </select>
</div>
<div class="form-group">
    <label for="nome">Nome</label>
    <input type="input" name="nome">
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" name="email">
</div>
<div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" name="senha">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Cadastrar">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
<li><?php echo anchor('user/view','Lista')?></li>
</form>
