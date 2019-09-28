<h2><?php echo $title; ?></h2>
<a href="<?php echo base_url().'user/create'; ?>" class="btn btn-outline-primary" title="Adicionar">+</a>
<table class='table'>
    <thead>
        <tr>
            <th>Nome</td>
            <th>e-mail</td>
            <th>Data de Inscrição</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($users as $users_item) {
        echo '<tr>'.PHP_EOL;
        echo '<td>'.$users_item['nome'].'</td>'.PHP_EOL;
        echo '<td>'.$users_item['email'].'</td>'.PHP_EOL;
        echo '<td>'.$users_item['dth_inscricao'].'</td>'.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>

<a href="<?php echo $this->session->acao_origem; ?>" class="btn btn-secondary">Voltar</a>
