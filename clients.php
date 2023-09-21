<?php


require_once 'configuration/Connect.php';
require_once 'templates/header.html.php';
$db=Connect::connect();
$sql= $db->prepare('SELECT * FROM customers');
$customers = $sql->execute();
$customers = $sql->fetchAll(PDO::FETCH_ASSOC);

?>


<h3 class="text-center mt-4">Liste des clients</h2>
<div class="rounded p-3 m-4 bg-light shadow">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="">Firstname</th>
                <th scope="col" class="">Lastname</th>
                <th scope="col" class="">age</th>
                <th scope="col" class="">caution</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
        <tr>
                <td><?= $customer['firstname'] ?></td>
                <td><?= $customer['lastname'] ?></td>
                <td><?php 
                $date = new dateTime('now');
                 echo $result = $date->format('Y') - $customer['year'] ;?></td>
                <td><?php if($customer['deposit'] === 1){
                    echo '<p class="badge bg-success text-light rounded_pill">Déposé</p>';
                }else
                {
                    echo '<p class="badge bg-danger text-light rounded_pill">Non déposé</p>';
                } ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php

require 'templates/footer.html.php';
