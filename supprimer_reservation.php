<?php
require_once 'Classes/Book.php';
require_once 'Classes/Client.php';
require_once 'classes/Reservation.php';
// supprimer_reservation.php
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    Reservation::deleteReservation($id);
    header('Location: reservations.php'); // Redirigez vers la page des réservations après la suppression.
    exit;
}
