<?php
/**
 * fichier de composants (partials) pour la 
 * liste de slivres sous forme de cartes
 */
require_once('classes/Book.php');

foreach(Book::getBooks() as $book){ ?>
    
  <div class="card col-md-3 col-sm-5 col-sm-12 card-bg">
     <div class="card-body text-light">
         <h5 class="card-title"><?=substr($book['title'],0,15) ?>...</h5>
         <h6 class="card-subtitle mb-2"><?=$book['author'] ?></h6>
         <p class="card-text"><?=substr($book['description'],0,100) ?>... </p>
         <a href="/book.php?slug=<?= $book['slug'] ;?>" class="btn btn-sm btn-outline-light">Voir</a>
         <a href="#" class="btn btn-sm btn-success">Réserver</a>
       
 </div>
  </div>

<?php } ?>

<?php

/*
foreach(Book::getBooks() as $book)
{ 

   echo ' <div class="card col-md-3 col-sm-5 col-sm-12 card-bg">';
   echo '     <div class="card-body text-light">';
   echo '         <h5 class="card-title">' . $book['title'] . '</h5>';
   echo '         <h6 class="card-subtitle mb-2">Card subtitle</h6>';
   echo '         <p class="card-text"> </p>';
   echo '         <a href="#" class="btn btn-sm btn-outline-light">Voir</a>';
   echo '         <a href="#" class="btn btn-sm btn-success">Réserver</a>';
   echo '     </div>';
   echo ' </div>';

}
*/