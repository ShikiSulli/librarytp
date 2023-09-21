<?php
require('classes/Book.php');
$totalbooks = count(Book::getBooks());
//traitement du formulaire
if(!empty($_POST))
{
    $book = new Book();
    $book->setTitle($_POST['title'])
         ->setAuthor($_POST['author'])
         ->setCategory($_POST['category'])
         ->setYear($_POST['year'])
         ->setIsbn($_POST['isbn'])
         ->setSlug($_POST['title'])
        ;
        Book::addBook($book);
}
if(isset($_GET['success']) && $_GET['success'] === 1)
{
    echo '<div class="alert alert-success" role="alert">
  Enregistrement effectué !
</div>';

} else if(isset($_GET['success']) && $_GET['success'] === 0)
    {
     echo '<div class="alert alert-danger" role="alert">
    Merci de réessayer !
    </div>';
    }

require_once 'templates/header.html.php';

?>

<!-- Bibliothèque-->
<div class="text-center mt-4">
<h2 >Bibliothèque<span class='badge rounded-pill text-bg-primary mx-2'><?= $totalbooks; ?></span>
</h2>
<button class="btn btn-outline-primary text-center" data-bs-toggle="modal" data-bs-target="#addBook">Ajouter un livre </button>
</div>

<div class="row rounded p-3 m-4 d-flex gap-4 bg-light shadow switch-row">

<?php include ('templates/_partials/_books-card.html.php'); ?>


</div>

<!--modal-->
<div class="modal fade" id="addBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un livre</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method='POST'>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name= "title" class="form-control" id="title" aria-describedby="authorHelp"required>
    <div id="authorHelp" class="form-text">Saisissez le titre d'un livre</div>
  </div>
  <div class="mb-3">
    <label for="author" class="form-label">Auteur</label>
    <input type="text" name= "author" class="form-control" id="author" aria-describedby="authorHelp" required>
    <div id="authorHelp" class="form-text">Saisissez l'auteur du livre</div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Résumé</label>
    <input type="text" name= "description" class="form-control" id="description" aria-describedby="descriptionHelp" required>
    <div id="descriptionHelp" class="form-text">Saisissez le résusmé </div>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Selectionnez une catégorie</label>
    <select name="category" list='listcategory'  class="form-control" id="category" required >
    <option value="roman">Roman</option>
    <option value="theatre">Théàtre</option>
    <option value="biography">Biographie</option>
    <option value="poesie">Poèsie</option>
    <option value="essai">Essai</option>
</select>
  </div>
  <div class="mb-3">
    <label for="year" class="form-label">Année de L'édition</label>
    <input type="text" name= "year" class="form-control" id="year" aria-describedby="yearHelp"required>
    <div id="yearHelp" class="form-text">Saisissez l'année de parution du livre</div>
  </div>
  <div class="mb-3">
    <label for="isbn" class="form-label">fournissez l'ISBN du livre</label>
    <input type="text" name= "isbn" class="form-control" id="isbn" aria-describedby="isbnHelp" required>
    <div id="isbnHelp" class="form-text">Format attendu </div>
  </div>
  <button type="submit" class="btn btn-success">
            <i class ="bi bi-save"></i>Sauvegarder</button>
</form>
      </div>
<!--<div class="modal-footer">
<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
</div>-->
    </div>
  </div>
</div>
<?php

require 'templates/footer.html.php';
