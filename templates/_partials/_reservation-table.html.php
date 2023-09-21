<?php
/**
 * fichier de composants (partials) pour la 
 * liste de slivres sous forme de cartes
 */

require_once('classes/Reservation.php');

if(!empty($_POST)) {
    empty($_POST['isClosed']) ? $closed = false : $closed = true;
    empty($_POST['isArchived']) ? $archived = false : $archived = true;

    // Récupérez l'ID de la réservation depuis le formulaire (assurez-vous que 'reservation_id' est le bon nom)
    $reservationId = $_POST['reservation_id'];

    // Créez un nouvel objet Reservation
    $reservation = new Reservation();
    $reservation->setId($_POST['id'])
                ->setBookId($_POST['book_id'])
                ->setClientId($_POST['client_id'])
                ->setDateStart($_POST['date_start'])
                ->setDateEnd($_POST['date_end'])
                ->setDateReturn($_POST['date_return'])
                ->setIsClosed($closed)
                ->setIsArchived($archived)
    ;

    // Utilisez la méthode updateReservation avec l'ID de la réservation
    Reservation::updateReservation($id, $bookId, $clientId, $dateStart, $dateEnd, $dateReturn, $isClosed, $isArchived);
}else{
    $clients = Client::getCustomers();
    $books = Book::getBooks();
    $customers = Reservation::getCurrentReservation();
}




if (isset($_POST['id'])) //si la donnée id existe dans le tableau $_POST
{
    if (isset($_POST['delete'])){

        Reservation::deleteReservation($_POST['id']);
    }


}



?>
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
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

<?php foreach(Reservation::getAllReservation() as $item) : ?>
    <tr>
        <td> <a href="/reservation.php?id=<?=$item['id'];?>" class="btn btn-sm btn-outline-light"><?=$item['id']?></a></td>
        <td><?= $item['title'] ?> </td>
        <td><?= $item['firstname'] . " " . $item['lastname'] ?> </td>
        <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_start']))->format('d/m/Y'); ?></td>
        <td><?= (DateTime::createFromFormat('Y-m-d', $item['date_end']))->format('d/m/Y'); ?></td>
        <td> <?= isset($item['date_return']) ? (DateTime::createFromFormat ('Y-m-d', $item['date_return']))->format('d/m/Y') : "" ; ?></td>
        <td><?= $item['isClosed'] ? 1 : 0 ?> </td>
        <td>
            <?php if (!$item['isClosed']) : ?>
                <a href="/reservations.php?idResa=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Retourner</a>
            <?php endif ?>
        </td>

        <!--bouton modifier-->
        <td>
        <form method="POST" action="update_reservation.php">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
            <button type="button" name='edit' class="btn btn-sm btn-warning" data-bs-toggle='modal' data-bs-target='#updateReservation'>
            Modifier</button>
        </td>

        <!--bouton supprimer-->
        <td><form method="POST" action="supprimer_reservation.php">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
            </form></td>
        
    </tr>
<?php endforeach ?>

<!-- modal updateReservation-->
<div class="modal fade" id="updateReservation" tabindex="-1" role="dialog" aria-labelledby="updateReservationLabel<?= $item['id'] ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateReservationLabel<?= $item['id'] ?>">Modifier une Réservation</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="update_reservation.php">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">

            <div class="form-group">
                <label for="bookReservation">Livre</label>
                <select class="custom-select form-control" name="book_id" id="bookReservation" required>
                    <?php foreach($books as $book) : ?>
                        <option value="<?= $book['id'] ?>" <?= ($book['id'] == $item['book_id']) ? 'selected' : '' ?>><?= $book['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
                    
            <div class="form-group">
                <label for="clientReservation">Client</label>
                <select class="custom-select form-control" name="client_id" id="clientReservation" required>
                    <?php foreach($clients as $client) : ?>
                        <option value="<?= $client['id'] ?>" <?= ($client['id'] == $item['client_id']) ? 'selected' : '' ?>><?= $client['lastname'] . " " . $client['firstname'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
            <div class="form-group">
                <label for="startReservation">Début</label>
                <input type="date" class="form-control" name="date_start" id="startReservation" value="<?= $item['date_start'] ?>" required>
            </div>

            <div class="form-group">
                <label for="endReservation">Fin</label>
                <input type="date" class="form-control" name="date_end" id="endReservation" value="<?= $item['date_end'] ?>" required>
            </div>

            <div class="form-group">
                <label for="returnReservation">Retour</label>
                <input type="date" class="form-control" name="date_return" id="returnReservation" value="<?= $item['date_return'] ?>">
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="isClosed" id="isClosed" <?= ($item['isClosed']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="isClosed">Cloturé ?</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="isArchived" id="isArchived" <?= ($item['isArchived']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="isArchived">Archivé ?</label>
            </div>

            <div class="row mt-2 offset-md-1">
                <div class="col-md-5">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save mx-2"></i>
                        Enregistrer
                    </button>
                </div>
                <div class="col-md-5 offset-md-1">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle mx-2"></i>
                        Annuler
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

            
</tbody>
</table>

