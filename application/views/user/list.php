<h2><?php echo $title; ?></h2>

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
        echo '<td>'.$users_item['data_inscricao'].'</td>'.PHP_EOL;
        echo '</tr>'.PHP_EOL;
    }?>
    </tbody>
</table>