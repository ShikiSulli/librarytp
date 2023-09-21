<?php
/**
 * fichier de composants (partials) pour la 
 * liste de slivres sous forme de cartes
 */
require_once('classes/Reservation.php');
?>
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Voir</th>
                <th scope="col">Livre</th>
                <th scope="col">Client</th>
                <th scope="col">Début</th>
                <th scope="col">Fin</th>
                <th scope="col">Retour</th>
                <th scope="col">Cloturé</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

<?php


foreach(Reservation::getCurrentReservation() as $resa){
    include '_reservation-row.html.php';
} 
?>
</tbody>
</table>

