<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('course/create'); ?>

<div class="form-group">
	<select name="id_categoria" autofocus class="form-control" title="Categoria">
		<?php foreach ($category as $category_item){
			echo '<option value='.$category_item['id'].'>'.$category_item['nome'].'</option>'.PHP_EOL;
		}?>
	</select>
</div>
<div class="form-group">
<!--    <label for="nome">Curso</label>-->
    <input type="input" class="form-control"  name="nome" placeholder="Curso" value="<?=isset($course)?$course['nome']:'';?>">
</div>
<div class="form-group">
	<!--    <label for="descricao">Descrição</label>-->
	<input type="input" class="form-control"  name="descricao" placeholder="Descrição" value="<?=isset($course)?$course['descricao']:'';?>">
</div>

<input type="hidden" name="hdnId" value="<?=isset($course)?$course['id']:'';?>">
<input class="btn btn-primary" type="submit" name="submit" value="<?=isset($course)?'Atualizar':'Cadastrar';?>">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
