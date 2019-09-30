<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('category/create'); ?>

<div class="form-group">
<!--    <label for="nome">Categoria</label>-->
    <input type="input" class="form-control"  name="nome" placeholder="Categoria" value="<?=isset($category)?$category['nome']:'';?>">
</div>
<div class="form-group">
	<!--    <label for="descricao">Descrição</label>-->
	<input type="input" class="form-control"  name="descricao" placeholder="Descrição" value="<?=isset($category)?$category['descricao']:'';?>">
</div>

<input type="hidden" name="hdnId" value="<?=isset($category)?$category['id']:'';?>">
<input class="btn btn-primary" type="submit" name="submit" value="<?=isset($category)?'Atualizar':'Cadastrar';?>">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
