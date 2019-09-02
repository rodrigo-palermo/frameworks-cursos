<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('user/create'); ?>

<?php $profile = $this->load->model('Profile_model');?>

<div class="form-group">
    <label for="perfil">Perfil</label>
    <select name="perfil" autofocus>
<!--        <option value="adm">Administrador</option>-->
<!--        <option value="prof">Professor</option>-->
<!--        <option value="aluno">Aluno</option>-->
    <?php foreach ($profile->get_profile() as $p){
        echo "<option value=";
    }
    ?>
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
    <label for="password">Senha</label>
    <input type="password" name="password">
</div>

<input class="btn btn-primary" type="submit" name="submit" value="Cadastrar">

</form>