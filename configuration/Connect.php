<?php

class Connect
{
private $db_name = 'biblioapp';
private $db_user = 'root';
private $db_pass = 'root';
private $db_host = '127.0.0.1:3306';
//methodes

/*
*une methode statique permet de faire appel a une methode sans instancier la classe
*
*/
public static function connect()
{  
     $db_name = 'biblioapp';
     $db_user = 'root';
     $db_pass = '';
     $db_host = '127.0.0.1:3306';
    try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  //  echo "Connexion à la base de données réussie";

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

}
}