<?php

/**
 * fichier de composant pour une réservation sous forme de ligne d'un tableau
 */


require_once 'classes/Reservation.php';

 ?>

 <tr>
    <td><a href="/reservation.php?id=<?= $resa['id'] ;?>" 
    class="btn btn-sm btn-outline-light"><?= $resa['id'] ?></a></td>
    <td><?= $resa['title'] ?></td>
    <td><?= $resa['firstname'] . " " . $resa['lastname'] ?></td>
    <td><?= (DateTime::createFromFormat('Y-m-d', $resa['date_start']))->format('d/m/Y'); ?></td>
    <td><?= (DateTime::createFromFormat('Y-m-d', $resa['date_end']))->format('d/m/Y'); ?></td>
    <td><?= $resa['isClosed'] ?></td>
    <td><a href="#" class="btn btn-sm btn-warning">Clôturer</a></td>
</tr>
