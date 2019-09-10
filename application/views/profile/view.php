<h2><?php echo $title; ?></h2>

<table class='table'>
    <thead>
        <tr>
            <th>id</td>
            <th>Perfil</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($profiles as $profile_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$profile_item['id'].'</td>'.PHP_EOL;
        echo '<td>'.$profile_item['nome'].'</td>'.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>

<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
<li><?php echo anchor('profile/create','Cadastro')?></li>
