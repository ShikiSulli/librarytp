<?php
class Reservation {
    private ?int $id;
    private ?int $book_id;
    private ?int $client_id;
    private ?string $date_start;
    private ?string $date_end;
    private ?string $date_return;
    private ?string $status;
    private ?bool $isClosed;
    private ?bool $isArchived;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getBookId() {
        return $this->book_id;
    }

    public function setBookId($book_id) {
        $this->book_id = $book_id;
        return $this;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
        return $this;
    }

    public function getDateStart() {
        return $this->date_start;
    }

    public function setDateStart($date_start) {
        $this->date_start = $date_start;
        return $this;
    }

    public function getDateEnd() {
        return $this->date_end;
    }

    public function setDateEnd($date_end) {
        $this->date_end = $date_end;
        return $this;
    }

    public function getDateReturn() {
        return $this->date_return;
    }

    public function setDateReturn($date_return) {
        $this->date_return = $date_return;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

 
    public function getIsClosed()
    {
        return $this->isClosed;
    }

    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    public function getIsArchived()
    {
        return $this->isArchived;
    }

    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }
    public static function getCurrentReservation() : array
    {
        //requet sql pour recup tous les résa en cours 
        $sql = "SELECT cbr.*, book.*, customers.*
        FROM customers_books_reservations AS cbr
        LEFT JOIN book ON cbr.book_id = book.id
        LEFT JOIN customers ON cbr.client_id = customers.id
        WHERE cbr.isClosed = 0 AND cbr.isArchived = 0
        ORDER BY cbr.date_start
        LIMIT 15;";

     $db = Connect::connect();
    
     $query = $db->prepare($sql);
     $query->execute();
     $resa = $query->fetchAll(PDO::FETCH_ASSOC);
     return $resa;
     
    }
    
    public static function getAllReservation() : array
    {
        //requet sql pour recup tous les résa en cours 
        $sql = "SELECT cbr.*, book.title, customers.firstname, customers.lastname
        FROM customers_books_reservations AS cbr
        LEFT JOIN book ON cbr.book_id = book.id
        LEFT JOIN customers ON cbr.client_id = customers.id
        ORDER BY isArchived, isClosed, cbr.date_start;";

     $db = Connect::connect();
    
     $query = $db->prepare($sql);
     $query->execute();
     $resa = $query->fetchAll(PDO::FETCH_ASSOC);
     return $resa;
     
    }
    
    public static function closeReservation($id): void
    {
        
         //requête SQL pour cloturer une réservation
         $sql = "UPDATE customers_books_reservations SET isClosed= 1, date_return = :dateRetour WHERE id = :id ;";
         $dateRetour = (new DateTime('now'))->format('Y-m-d');
         //connexion bdd
         $db = Connect::connect();
         //On effectue le query sur la bdd
         $query = $db->prepare($sql);
         //On lie les valeurs aux paramètres
         $query->bindValue(':id', $id , PDO::PARAM_INT);
         $query->bindValue(':dateRetour', $dateRetour , PDO::PARAM_STR);
        
         //On execute la requete sur la bdd
         $query->execute();

         //redirection vers reservations.php
         //header('Location: /reservations.php');
     }
     public static function addReservation($obj): void
     {
         $sql = "INSERT INTO customers_books_reservations (book_id, client_id, date_start, date_end, date_return, isClosed, isArchived)
                 VALUES (:book_id, :client_id, :date_start, :date_end, :date_return, :isClosed, :isArchived)";
         
         $db = Connect::connect();
         $query = $db->prepare($sql);
     
         // Utilisez les méthodes de l'objet pour obtenir les valeurs
         $query->bindValue(':book_id', $obj->getBookId(), PDO::PARAM_INT);
         $query->bindValue(':client_id', $obj->getClientId(), PDO::PARAM_INT);
         $query->bindValue(':date_start', $obj->getDateStart(), PDO::PARAM_STR);
         $query->bindValue(':date_end', $obj->getDateEnd(), PDO::PARAM_STR);
         $query->bindValue(':date_return', $obj->getDateReturn(), PDO::PARAM_STR);
         $query->bindValue(':isClosed', $obj->getIsClosed(), PDO::PARAM_BOOL);
         $query->bindValue(':isArchived', $obj->getIsArchived(), PDO::PARAM_BOOL);
     
         $query->execute();
     
         if ($query->rowCount() > 0) {
             header('Location: reservations.php?success=1');
         } else {
             header('Location: reservations.php?success=0');
         }
     }
     
     public static function deleteReservation($id): void
     {
         $db = Connect::connect();
     
         $query = $db->prepare("DELETE FROM customers_books_reservations WHERE id = :id");
     
         $query->bindValue(':id', $id, PDO::PARAM_INT);
     
         $query->execute();
     
         header('Location: reservations.php');
     }
     public static function updateReservation($obj): void
{
    $sql = "UPDATE customers_books_reservations
            SET book_id = :bookId,
                client_id = :clientId,
                date_start = :dateStart,
                date_end = :dateEnd,
                date_return = :dateReturn,
                isClosed = :isClosed,
                isArchived = :isArchived
            WHERE id = :id";

    $db = Connect::connect();
    $query = $db->prepare($sql);

    // Liaison des paramètres avec les valeurs de l'objet Reservation
    $query->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
    $query->bindValue(':bookId', $obj->getBookId(), PDO::PARAM_INT);
    $query->bindValue(':clientId', $obj->getClientId(), PDO::PARAM_INT);
    $query->bindValue(':dateStart', $obj->getDateStart(), PDO::PARAM_STR);
    $query->bindValue(':dateEnd', $obj->getDateEnd(), PDO::PARAM_STR);
    $query->bindValue(':dateReturn', $obj->getDateReturn(), PDO::PARAM_STR);
    $query->bindValue(':isClosed', $obj->getIsClosed(), PDO::PARAM_BOOL);
    $query->bindValue(':isArchived', $obj->getIsArchived(), PDO::PARAM_BOOL);

    $query->execute();
}

    }

    


