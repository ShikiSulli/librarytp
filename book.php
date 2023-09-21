<?php
require 'classes/Book.php';
require 'templates/header.html.php';
/**
* Page d'un livre seul
*/
$book = Book::getOneBook($_GET['slug']);


if (isset($_POST['id'])) //si la donnée id existe dans le tableau $_POST
{
    if (isset($_POST['delete'])){

        Book::deleteBook($_POST['id']);
//on execute la methode deletebook
    }
    else if(isset($_POST['edit'])){
        $book = new Book();
        $book ->setTitle($_POST['title'])
                ->setAuthor($_POST['author'])
                ->setDescription($_POST['description'])
                ->setCategory($_POST['category'])
                ->setYear($_POST['year'])
                ->setIsbn($_POST['isbn'])
                ->setSlug($_POST['title'])
        ;
        Book::editBook($book, $_POST['id']);
    }

}


?>
<div class='justify-content-center d-flex gap-3'>

            <button type="button" name='edit' class="btn btn-sm btn-outline-dark" data-bs-toggle='modal' data-bs-target='#editBook'>
            Modifier</button>

<form method ='post'>
   
    <input name='id' type="number" value="<?= $book['id'] ;?>" hidden>
    <input name="delete" type="submit" class="btn btn-sm btn-outline-dark" value="Supprimer">
  
</form>

</div>


<div class="modal fade" id="editBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier : <?= $book['title'] ;?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method='POST'>
        <input name='id' type="number" value="<?= $book['id'] ;?>" hidden> <!--HIDDEN-->
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name= "title" class="form-control" id="title" aria-describedby="titleHelp" value="<?= $book['title'] ;?>"required>
    <div id="titleHelp" class="form-text">Saisissez le titre d'un livre</div>
  </div>
  <div class="mb-3">
    <label for="author" class="form-label">Auteur</label>
    <input type="text" name= "author" class="form-control" id="author" aria-describedby="authorHelp" value="<?= $book['author'] ;?>" required>
    <div id="authorHelp" class="form-text">Saisissez l'auteur du livre</div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Résumé</label>
    <input type="text" name= "description" class="form-control" id="description" aria-describedby="descriptionHelp" value="<?= $book['description'] ;?>" required>
    <div id="descriptionHelp" class="form-text">Saisissez le résusmé </div>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Selectionnez une catégorie</label>
    <input name="category" list='listcategory'  class="form-control" id="category" required value="<?= $book['category'] ;?>" >
    <datalist id='listcategory'>
    <option value="roman">Roman</option>
    <option value="theatre">Théàtre</option>
    <option value="biography">Biographie</option>
    <option value="poesie">Poèsie</option>
    <option value="essai">Essai</option>
    </datalist>
  </div>
  <div class="mb-3">
    <label for="year" class="form-label">Année de L'édition</label>
    <input type="text" name= "year" class="form-control" id="year" aria-describedby="yearHelp" value="<?= $book['year'] ;?>"required>
    <div id="yearHelp" class="form-text">Saisissez l'année de parution du livre</div>
  </div>
  <div class="mb-3">
    <label for="isbn" class="form-label">fournissez l'ISBN du livre</label>
    <input type="text" name= "isbn" class="form-control" id="isbn" aria-describedby="isbnHelp" value="<?= $book['isbn'] ;?>" required>
    <div id="isbnHelp" class="form-text">Format attendu </div>
  </div>
  <button name="edit" type="submit" class="btn btn-success">
            <i class ="bi bi-save"></i>Editer</button>
</form>
      </div>

      <?php
      require 'templates/footer.html.php';