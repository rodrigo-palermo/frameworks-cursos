<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('content/create_on_course/'.$course['id']); ?>

<div class="form-group">
	<select name="id_curso" autofocus class="form-control" title="Curso">
		<?php
			echo '<option value='.$course['id'].'>'.$course['nome'].'</option>'.PHP_EOL;
		?>
	</select>
</div>
<div class="form-group">
<!--    <label for="nome">Conteudo</label>-->
    <input type="input" class="form-control"  name="nome" placeholder="Conteudo" value="<?=isset($content)?$content['nome']:'';?>">
</div>
<div class="form-group">
	<!--    <label for="descricao">Descrição</label>-->
	<input type="input" class="form-control"  name="descricao" placeholder="Descrição" value="<?=isset($content)?$content['descricao']:'';?>">
</div>

<input type="hidden" name="hdnId" value="<?=isset($content)?$content['id']:'';?>">
<input class="btn btn-primary" type="submit" name="submit" value="<?=isset($content)?'Atualizar':'Cadastrar';?>">
<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
</form>
