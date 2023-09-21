<?php
require_once 'Classes/Book.php';
require_once 'Classes/Client.php';
require_once 'classes/Reservation.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $bookId = $_POST['book_id'];
    $clientId = $_POST['client_id'];
    $dateStart = $_POST['date_start'];
    $dateEnd = $_POST['date_end'];
    $dateReturn = $_POST['date_return'];
    $isClosed = isset($_POST['isClosed']) ? 1 : 0;
    $isArchived = isset($_POST['isArchived']) ? 1 : 0;

    // Créez un objet Reservation avec les données du formulaire
    $obj = new Reservation();
    $obj->setId($id)
                ->setBookId($bookId)
                ->setClientId($clientId)
                ->setDateStart($dateStart)
                ->setDateEnd($dateEnd)
                ->setDateReturn($dateReturn)
                ->setIsClosed($isClosed)
                ->setIsArchived($isArchived);

    // Mettez à jour la réservation en utilisant l'objet $obj
    Reservation::updateReservation($obj);

    // Redirigez l'utilisateur vers la page de liste des réservations ou une autre page appropriée
    header('Location: reservations.php');
    exit();
} else {
    // Gérez le cas où la requête n'est pas une requête POST, par exemple, une redirection ou un message d'erreur
    echo "Une erreur s'est produite.";
}
