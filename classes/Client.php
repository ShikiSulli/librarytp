<?php
class Client {
    private ?int $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $password;
    private ?string $address;
    private ?string $city;
    private ?string $zip;
    private ?string $country;
    private ?string $phone;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }
    public static function getCustomerByName() : array
{
  
    $sql = "SELECT * FROM book WHERE lastname = :lastname";
 $db = Connect::connect();

 $query = $db->query($sql);
 $query->execute();
 $books = $query->fetchAll(PDO::FETCH_ASSOC);
 return $books;
 
}
public static function getCustomers() : array
    {
        //requet sql pour recup tous les résa en cours 
        $sql = "SELECT * FROM customers
        ORDER BY lastname, firstname";

     $db = Connect::connect();
     $query = $db->prepare($sql);
     $query->execute();
     $customer = $query->fetchAll(PDO::FETCH_ASSOC);
     return $customer;
     
    }
    
}

