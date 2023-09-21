<?php
class Reservation {
    private ?int $id;
    private ?int $book_id;
    private ?int $client_id;
    private ?string $date_start;
    private ?string $date_end;
    private ?string $date_return;
    private ?string $status;

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
}

